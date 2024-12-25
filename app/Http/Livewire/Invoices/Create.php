<?php

namespace App\Http\Livewire\Invoices;

use App\Models\User;
use App\Models\Offer;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\Department;
use App\Models\PaymentMethod;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Prgayman\Zatca\Facades\Zatca;
use Prgayman\Zatca\Utilis\QrCodeOptions;
use App\Notifications\InvoiceNotification;
use Illuminate\Support\Facades\Notification;

class Create extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public  $use_package, $lastPackageBalance, $package_id, $package_balance = 0, $department_id = null, $invoice_id, $date, $product_id, $items = [], $price, $tax, $total = 0, $discount, $client_phone, $client_id, $client, $edit_mode = false, $unpaid_invoice_id, $invoice, $qrCode, $not_paid, $offers_discount, $amount_after_offers_discount, $selected_product, $rest = 0;
    public $barcode, $payments = [], $total_paid, $start_amount, $end_amount, $current_user_session, $payment_methods = [];
    public function getClient()
    {
        if ($this->client_phone) {
            $this->client = Client::where('phone', $this->client_phone)->first();
            if ($this->client) {
                $this->client_id = $this->client->id;
                if (setting('active_free_invoice')) {
                    if ($this->client->invoices_number == 10 || $this->client->invoices_amount >= setting('amount_free_invoice')) {
                        $this->emit('free-invoice');
                    }
                }

                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم إيجاد العميل بنجاح']);
            } else {
                $client = Client::create(['name' => 'عميل نقدي', 'phone' => $this->client_phone, 'social_situation' => 'single']);
                $this->client = $client;
                $this->client_id = $client->id;
                $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'عذرا, لم يتم إيجاد العميل وتم تسجيله تلقائيا في النظام']);
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'يرجى إدخال رقم العميل']);
        }
    }

    public function edit()
    {
        $this->invoice_id = $this->unpaid_invoice_id;
        $this->edit_mode = true;
        $this->invoice = Invoice::findOrFail($this->invoice_id);
        $this->date = $this->invoice->date;
        $this->items = $this->invoice->items()->get()->toArray();
        $this->discount = $this->invoice->discount;
        $this->computeForAll();
    }

    public function add_product(Product $product)
    {
        if ($product->allow_quantity && $product->quantity < 1) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'الكمية غير كافية']);
        } else {

            $tax_value = setting('active_tax') ?  setting('tax') : 0;
            $newArr = array_filter($this->items, function ($item) use ($product) {
                return $item['product_id'] == $product->id;
            });

            $price = $product->saleprice;
            $tax = 0;

            $discount = 0;
            $offer = null;
            $globalOffer = Offer::where('type', 'all')->first();
            if ($product->offer && $product->offer->end >= date('Y-m-d')) {
                $this->discount = $product->saleprice * ($product->offer->rate / 100);
                $offer = $product->offer->id;
            } elseif ($globalOffer && $globalOffer->end >= date('Y-m-d')) {
                $this->discount = (($product->saleprice) * ($globalOffer->rate / 100)) * 1;
                $offer = $globalOffer->id;
            }

            if (count($newArr) > 0) {
                $key = array_keys($newArr)[0];
                ++$this->items[$key]['quantity'];
                if ($product->allow_quantity && $product->quantity < $this->items[$key]['quantity']) {
                    --$this->items[$key]['quantity'];

                    $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'الكمية غير كافية']);
                } else {

                    $this->items[$key]['price'] = $product->saleprice;
                    $this->items[$key]['tax'] = ($product->saleprice * ($tax_value / 100)) * $this->items[$key]['quantity'];

                    if (setting('price_include_tax')) {
                        $this->items[$key]['price'] = ($price * 100 / (100 + setting('tax')));
                        $this->items[$key]['tax'] =  ($this->items[$key]['price'] * setting('tax') / 100) * $this->items[$key]['quantity'];
                    } elseif (setting('active_tax')) {
                        $this->items[$key]['price'] = $price;
                        $this->items[$key]['tax'] = ($this->items[$key]['price'] * setting('tax') / 100) * $this->items[$key]['quantity'];
                    }

                    $this->items[$key]['total'] = round(($this->items[$key]['price'] * $this->items[$key]['quantity']) + $this->items[$key]['tax'] - floatval($this->discount), 2);
                }

                // $this->items[$key]['saleprice'] = $this->items[$key]['quantity'] * $product->saleprice;

            } else {

                if (setting('price_include_tax')) {
                    $unit_price = $price * 100 / (100 + setting('tax'));
                    $tax =  $unit_price * setting('tax') / 100;
                } elseif (setting('active_tax')) {
                    $unit_price = $price;
                    $tax = $unit_price * (setting('tax') / 100);
                }

                $total = round($unit_price  + $tax - $this->discount, 2);

                $this->items[] = [
                    'invoice_id' => $this->invoice_id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'code' => $product->code,
                    'unit' => $product->unit?->name,
                    'price' =>  $unit_price,
                    'discount' => $this->discount,
                    'quantity' => 1,
                    'total' => $total,
                    'tax' => $tax,
                    'department_id' => $product->department->id,
                    'department_name' => $product->department->name,
                    'offer_id' => $offer,
                ];
            }
        }
        $this->computeForAll();
    }
    public function add_product_barcode()
    {
        // 123123
        $product = Product::whereNotNull('barcode')->where('barcode', $this->barcode)->first();
        if ($product) {
            $this->add_product($product);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم إضافة المنتج']);
            $this->reset('barcode');
            return 1;
        } elseif (!$product && $this->barcode) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'المنتج غير موجود']);
            $this->reset('barcode');
        }
    }

    public function increment($key)
    {
        $product = Product::find($this->items[$key]['product_id']);
        if ($product->allow_quantity) {
            if ($product->quantity <= $this->items[$key]['quantity']) {
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'اقصي عدد للمخزون هو : ' . $product->quantity]);
                $this->items[$key]['quantity'] = $product->quantity;
            } else {
                $this->items[$key]['quantity']++;
            }
        } else {
            $this->items[$key]['quantity']++;
        }
        $tax_value = setting('active_tax') ?  setting('tax') : 0;
        $price = $product->saleprice;
        $this->items[$key]['tax'] = ($product->saleprice * ($tax_value / 100)) * $this->items[$key]['quantity'];
        if (setting('price_include_tax')) {
            $this->items[$key]['price'] = ($price * 100 / (100 + setting('tax')));
            $this->items[$key]['tax'] =  ($this->items[$key]['price'] * setting('tax') / 100) * $this->items[$key]['quantity'];
        } elseif (setting('active_tax')) {
            $this->items[$key]['price'] = $price;
            $this->items[$key]['tax'] = ($this->items[$key]['price'] * setting('tax') / 100) * $this->items[$key]['quantity'];
        }
        $this->items[$key]['total'] = round(($this->items[$key]['price'] * $this->items[$key]['quantity']) + $this->items[$key]['tax'] - $this->discount, 2);

        $this->computeForAll();
    }

    public function decrement($key)
    {
        $this->items[$key]['quantity']--;
        $product = Product::find($this->items[$key]['product_id']);
        $price = $product->saleprice;
        $tax_value = setting('active_tax') ?  setting('tax') : 0;
        $this->items[$key]['tax'] = ($product->saleprice * ($tax_value / 100)) * $this->items[$key]['quantity'];
        if (setting('price_include_tax')) {
            $this->items[$key]['price'] = ($price * 100 / (100 + setting('tax')));
            $this->items[$key]['tax'] =  ($this->items[$key]['price'] * setting('tax') / 100) * $this->items[$key]['quantity'];
        } elseif (setting('active_tax')) {
            $this->items[$key]['price'] = $price;
            $this->items[$key]['tax'] = ($this->items[$key]['price'] * setting('tax') / 100) * $this->items[$key]['quantity'];
        }
        $this->items[$key]['total'] = round(($this->items[$key]['price'] * $this->items[$key]['quantity']) + $this->items[$key]['tax'] - $this->discount, 2);

        if ($this->items[$key]['quantity'] == 0) {
            unset($this->items[$key]);
        }

        $this->computeForAll();
    }

    public function deleteItems()
    {
        $this->items = [];
        $this->computeForAll();
    }

    public function delete_item($key)
    {
        unset($this->items[$key]);
        $this->computeForAll();
    }

    public function calculateRest()
    {
        $total_paid = array_reduce($this->payments, function ($carry, $item) {
            $carry += doubleval($item['amount']);
            return $carry;
        });

        $this->total_paid = $total_paid;

        if ($total_paid > $this->total) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'قيمة المدفوعات يجب أن تكون أقل من أو تساوي المبلغ النهائي ' . $this->total]);

            $this->rest = $this->total;
            return back();
        }

        $this->rest = round($this->total - $total_paid, 2);
    }

    public function addPayment()
    {
        $this->payments[] = [
            'payment_method_id' => '',
            'amount' => '',
            'type' => 'in',
            'user_id' => auth()->user()->id,
        ];
    }

    public function removePayment($index)
    {
        unset($this->payments[$index]);
        $this->payments = array_values($this->payments);
        $this->calculateRest();
    }

    public function updatedDiscount()
    {
        $this->computeForAll();
    }

    public function updatedPackageBalance()
    {
        $this->package_balance = $this->package_balance == "" ? 0 : $this->package_balance;
        if ($this->package_balance) {
            $this->package_balance = $this->package_balance == "" ? 0 : $this->package_balance;
        }
        $this->rest =  $this->total - ($this->package_balance);
    }

    public function updatedUsePackage()
    {
        if ($this->use_package) {
            $balance = $this->client->package->total_price - $this->lastPackageBalance;
            $this->package_balance =  $this->total > $balance ? $balance :  $this->total;
            $this->package_id = $this->client?->package?->id;
        } else {
            $this->package_balance = 0;
            $this->package_id = null;
        }
        $this->computeForAll();
    }

    public function computeForAll()
    {
        $this->price = array_reduce($this->items, function ($carry, $item) {
            $carry += $item['price'] * $item['quantity'];
            return $carry;
        });

        $this->tax = array_reduce($this->items, function ($carry, $item) {
            $carry += $item['tax'];
            return number_format($carry, 2);
        });


        // $this->discount = array_reduce($this->items, function ($carry, $item) {
        //     $carry += $item['discount'] * $item['quantity'];
        //     return $carry;
        // });


        $discount = $this->discount ? $this->discount : 0;

        $this->total = $this->price + $this->tax - $discount - $this->offers_discount;
        if ($this->use_package) {
            $balance = $this->client->package->total_price - $this->lastPackageBalance;
            $this->package_balance =  $this->total > $balance ? $balance :  $this->total;
            $this->package_id = $this->client?->package?->id;
        } else {
            $this->package_balance = 0;
            $this->package_id = null;
        }
        $this->amount_after_offers_discount = $this->price - $this->offers_discount;

        $this->calculateRest();

        if (setting('default_payment_method')) {
            if (setting('default_payment_method') == 'not_cash') {
                $payment_method = PaymentMethod::where('is_cash', 0)->where('default_payment', 1)->first();
                $index = array_search($payment_method->id, array_column($this->payments, 'payment_method_id'));
                $this->payments[$index]['amount'] = $this->total;
            } else {
                $index = array_search(auth()->user()->payment_method_id, array_column($this->payments, 'payment_method_id'));
                $this->payments[$index]['amount'] = $this->total;
            }
            $this->rest = 0;
        } else {
            $this->rest = $this->total;
        }
    }

    public function submit($status)
    {
        $this->getClient();
        $status = $status;

        $data = $this->validate([
            'items' => 'required',
            'price' => 'required',
            'total' => 'required',
            'rest' => 'nullable|numeric',
            'client_id' => 'nullable',
            'package_id' => 'nullable',
            'package_balance' => 'nullable',
        ]);


        if ($this->total_paid <= 0) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'يجب تحديد طريق دفع']);
            return;
        }

        if ($this->total_paid > $this->total) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'قيمة المدفوعات يجب أن تكون أقل من أو تساوي المبلغ النهائي ' . $this->total]);
            return;
        }

        if ($this->rest > 0) {
            $status = 'partially_paid';
        }
        if (setting('active_free_invoice')) {
            if ($this->client) {
                if ($this->client->invoices_number == 10 or $this->client->invoices_amount >= setting('amount_free_invoice')) {
                    $status = 'free';
                }
            }
        }
        $data = [
            'user_id' => auth()->user()->id,
            'client_id' => $this->client_id,
            'date' => $this->date,
            'tax' => round($this->tax, 2),
            'price' => round($this->price, 2),
            'total' => round($this->total, 2),
            'discount' => round($this->discount, 2),
            'rest' => round($this->rest, 2),
            'status' => $status,
            'package_balance' => $this->package_balance,
            'package_id' => $this->package_id,
            'offers_discount' => $this->offers_discount
        ];
        if ($this->edit_mode and $this->invoice) {
            $this->invoice->items()->delete();
            $this->invoice->payment_transactions()->delete();

            foreach ($this->items as $id => $quantity) {

                $product = Product::findOrFail($quantity['product_id']);

                $product->update([
                    'quantity' => $product->quantity + $quantity['quantity'],
                ]);
            } //end of foreach

            $this->invoice->update($data);
            $this->invoice->items()->createMany($this->items);

            if (count($this->payments) > 0) {
                foreach ($this->payments as $payment) {
                    if ($payment['amount'] > 0) {
                        $this->invoice->payment_transactions()->create($payment);
                    }
                }
            }

            foreach ($this->items as $id => $quantity) {

                $product = Product::findOrFail($quantity['product_id']);
                if ($product->quantity > 0) {
                    $product->update([
                        'quantity' => $product->quantity - $quantity['quantity']
                    ]);
                }
            } //end of foreach

        } else {

            $invoice = Invoice::create($data);
            $invoice->items()->createMany($this->items);

            foreach ($this->items as $id => $quantity) {

                $product = Product::findOrFail($quantity['product_id']);
                if ($product->quantity > 0) {
                    $product->update([
                        'quantity' => $product->quantity - $quantity['quantity']
                    ]);
                }
            } //end of foreach

            if (count($this->payments) > 0) {
                foreach ($this->payments as $payment) {
                    if ($payment['amount'] > 0) {
                        $invoice->payment_transactions()->create($payment);
                    }
                }
            }


            /* $users = User::where('user_category_id', 1)->get();

            foreach ($users as $key => $user) {
                Notification::send($user, new InvoiceNotification($invoice));
                $SERVER_API_KEY = 'AAAA58IZDYw:APA91bEEf8OWNrMDF-CJH3jKCvGC7oo1KkYmB07g1EEa4cI__Wa2ihyCIUl2BGdASmmU_LwZenYRNaia8-p81BeMmSTFOs6pLpVHvF8wIqjomBmYlm_JEA7bu23jitjy-TnnZjglDc5t';
                $token = $user->fcm_token;
                $data = [
                    "registration_ids" => [
                        $token
                    ],
                    "notification" => [
                        "title" => 'تم إضافة فاتورة جديدة بقيمة ' . $invoice->total . ' ر.س',
                        "sound" => "default"
                    ],
                ];
                $dataString = json_encode($data);
            }
            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            curl_exec($ch); */
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم إضافة الفاتورة بنجاح']);
        if (setting('active_invoice_print')) {
            return redirect()->route('invoices.show', $invoice->id);
        } else {
            $this->resetAll();
        }
    }

    public function resetAll()
    {
        $this->reset();
        $this->mount();
    }

    public function getInvoice($id)
    {
        $this->invoice = Invoice::with(['items', 'user', 'client'])->findOrFail($id);
        $qrCodeOptions = new QrCodeOptions();
        $qrCodeOptions->format('svg');
        $qrCodeOptions->backgroundColor(255, 255, 255);
        $qrCodeOptions->color(0, 0, 0);
        $qrCodeOptions->size(125);
        $qrCodeOptions->margin(0);
        $qrCodeOptions->style('square', 0.5);
        $qrCodeOptions->eye('square');
        if (strlen(setting('tax_no')) == 15) {
            $this->qrCode = Zatca::sellerName(setting('website_name'))
                ->vatRegistrationNumber(setting('tax_no'))
                ->timestamp($this->invoice->created_at)
                ->totalWithVat($this->invoice->total)
                ->vatTotal($this->invoice->tax)
                ->toQrCode($qrCodeOptions);
        }
    }


    public function updatedDepartmentId($department_id)
    {
        $this->resetPage();
    }

    public function mount()
    {
        // if($id!=0){
        //     $this->getInvoice($id);
        // }

        $invoice = Invoice::latest('id')->first();
        $this->date = now()->format('Y-m-d');
        $this->invoice_id = $invoice ? $invoice->id + 1 : 1;
        if (request('client_id')) {
            $this->client_id = request('client_id');
            $this->client = Client::find(request('client_id'));
            $this->client_phone = $this->client->phone;
        }

        $this->current_user_session = auth()->user()->user_sessions()->whereNull('end_time')->where('date', date('Y-m-d'))->latest()->first();
        $this->payment_methods = PaymentMethod::where('status', 1)->where('is_cash', 0)->get();

        foreach ($this->payment_methods as $key => $payment_method) {
            $this->payments[] = [
                'payment_method_id' => $payment_method->id,
                'payment_method_name' => $payment_method->name,
                'type' => 'in',
                'amount' => 0,
                'user_id' => auth()->user()->id,
                'user_session_id' => $this->current_user_session?->id,
            ];
        }
        $this->payments[] = [
            'payment_method_id' => auth()->user()->payment_method?->id,
            'payment_method_name' => auth()->user()->payment_method?->name,
            'type' => 'in',
            'amount' => 0,
            'user_id' => auth()->user()->id,
            'user_session_id' => $this->current_user_session?->id,
        ];
    }

    public function render(Request $request)
    {
        if ($request->id) {
            $this->getInvoice($request->id);
        }
        $departments = Department::all();
        $unpaid_invoices = Invoice::unpaid()->get();
        if ($this->client) {
            $this->lastPackageBalance = $this->client->invoices()->sum('package_balance');
        } else {
            $this->lastPackageBalance = 0;
        }
        $products = Product::where('department_id', $this->department_id)->paginate(10);

        return view('livewire.invoices.create', compact('departments', 'unpaid_invoices', 'products'));
    }

    public function saveSession()
    {
        $this->validate(['start_amount' => 'required|numeric']);

        UserSession::create([
            'user_id' => auth()->user()->id,
            'start_amount' => $this->start_amount,
            'start_time' => date('H:i A'),
            'date' => date('Y-m-d'),
        ]);

        return redirect()->route('invoices.create')->with('success', 'تم بدأ الجلسة بنجاح.');
    }

    public function endSession()
    {
        $this->validate(['end_amount' => 'required|numeric']);

        $this->current_user_session->update(['end_amount' => $this->end_amount, 'end_time' => date('H:i A')]);

        return redirect()->route('invoices.index')->with('success', 'تم إنهاء الجلسة بنجاح.');
    }

    public function calculateEndAmount()
    {
        if ($this->current_user_session->payment_transactions()->count() > 0) {

            $invoices = $this->current_user_session->payment_transactions()->where('payment_method_id', auth()->user()->payment_method_id)->where('type', 'in')->sum('amount') + $this->current_user_session->start_amount;

            $expenses = $this->current_user_session->payment_transactions()->where('payment_method_id', auth()->user()->payment_method_id)->where('type', 'out')->sum('amount');

            $this->end_amount = $invoices - $expenses;
        } else {
            $this->end_amount = $this->current_user_session->start_amount;
        }
    }
}
