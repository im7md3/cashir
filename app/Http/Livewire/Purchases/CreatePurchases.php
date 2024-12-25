<?php

namespace App\Http\Livewire\Purchases;

use Exception;
use App\Models\Branch;
use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PaymentMethod;
use App\Models\ProductQuantity;
use Illuminate\Support\Facades\DB;

class CreatePurchases extends Component
{
    public $supplier_id, $branch_id, $amount = 0, $items = [], $invoice_data, $tax = 0, $total = 0, $date, $payments = [], $current_user_session, $payment_methods = [];
    public $status,$paid,$rest;
    public function rules()
    {
        return [
            'supplier_id' => 'required',
            'branch_id' => setting('is_branches_active') ? 'required' : 'nullable',
            'amount' => 'required|numeric',
            'tax' => 'required|numeric',
            'total' => 'required|numeric',
            'date' => 'required|date',
            'items.*.barcode' => 'required',
            'items.*.product_id' => 'required',
            'items.*.quantity' => 'required|integer',
            'items.*.cost_price' => 'required|numeric',
            'items.*.sell_price' => 'required|numeric',
            'payments.*.payment_method_id' => 'required',
//            'payments.*.user_session_id' => 'required',
            'payments.*.amount' => 'nullable',
            'paid' =>'required',
            'rest' => 'nullable',
            'status' => 'required',
        ];
    }

    public function mount()
    {
        $this->addItem();
        $this->date = date('Y-m-d');

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

    public function render()
    {
        $branches = Branch::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $this->current_user_session = auth()->user()->user_sessions()->whereNull('end_time')->where('date', date('Y-m-d'))->latest()->first();
        return view('livewire.purchases.form', compact('branches', 'suppliers', 'products'))->extends('layouts.app')->section('content');
    }

    public function calculateRest()
    {
//        $remainingTotal = $this->total;
//
//        foreach ($this->payments as $index => $payment) {
//            $amount = (float)$payment['amount'];
//
//            if ($index === 0) {
//                $this->payments[$index]['amount'] = $remainingTotal;
//            } else {
//                if ($amount > 0) {
//                    $this->payments[0]['amount'] = max(0, $this->payments[0]['amount']
//                        - $amount);
//                    $remainingTotal -= $amount;
//                }
//            }
//        }
        $this->calculateTotal();
//        if ($this->total < collect($this->payments)->sum('amount')) {
//            $this->payments[0]['amount'] = $this->total;
//            foreach ($this->payments as $index => $payment) {
//                if ($index !== 0) {
//                    $this->payments[$index]['amount'] = 0;
//                }
//            }
//
//        }

    }

    public function updatedTax()
    {
        $this->total = $this->amount + $this->tax;
    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => '',
            'quantity' => '',
            'cost_price' => '',
            'sell_price' => '',
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function calculateTotal()
    {
        $this->amount = array_reduce($this->items, function ($carry, $item) {
            $carry += doubleval($item['cost_price']) * intval($item['quantity']);
            return round($carry, 2);
        });

        if (setting('active_tax')) {
            $this->tax = round($this->amount * (setting('tax') / 100), 2);
        }

        $this->total = round($this->tax + $this->amount, 2);
        if (setting('default_payment_method')) {
            if (setting('default_payment_method') == 'not_cash') {
                $payment_method = PaymentMethod::where('is_cash', 0)->where('default_payment', 1)->first();
                $index = array_search($payment_method->id, array_column($this->payments, 'payment_method_id'));
//                $this->payments[$index]['amount'] = $this->total;
            } else {
                $index = array_search(auth()->user()->payment_method_id, array_column($this->payments, 'payment_method_id'));
//                $this->payments[$index]['amount'] = $this->total;
            }
        }
        foreach ($this->payments as $index => $pa) {
            if ($this->payments[$index]['amount'] == ''){
                $this->payments[$index]['amount']=0;
            }
        }


        $total_amount =(float) collect($this->payments)->sum('amount');
        $this->paid =  round($total_amount, 2);
        $this->rest = $this->total - $this->paid;
        $this->status = $this->getStatus();

        if (collect($this->payments)->sum('amount') > $this->total){
            foreach ($this->payment_methods as $key => $payment_method){
              $this->payments[$key]['amount'] = 0;
              $this->reset('paid','rest');
            }
        }
    }

    private function getStatus()
    {
        if ($this->paid === $this->total) {
            return 'paid';
        }

        if ($this->rest === $this->total) {
            return 'unpaid';
        }

        return 'paid_partially';
    }

    public function getProduct($index, $value)
    {
        $product = Product::where('barcode', $value)->first();
        $this->items[$index]['product_id'] = $product?->id;
        $this->items[$index]['cost_price'] = $product?->price;
        $this->items[$index]['sell_price'] = $product?->saleprice;

    }

    public function save()
    {
        $data = $this->validate();

        try {
            DB::beginTransaction();
            $invoice = Purchase::create($data);
            $invoice->branch_id = $this->branch_id;
            $invoice->save();
            $invoice->items()->createMany($this->items);

            foreach ($this->items as $item) {

                ProductQuantity::create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'type' => 'charge',
                    'purchase_id' => $invoice->id
                ]);

                $product = Product::find($item['product_id']);
                $product->update(['saleprice' => $item['sell_price']]);
            }

            if (count($this->payments) > 0) {
                foreach ($this->payments as $payment) {
                    if ($payment['amount'] > 0) {
                        $invoice->payment_transactions()->create($payment);
                    }
                }
            }

            DB::commit();

            return redirect()->route('purchases')->with('success', 'تم الحفظ بنجاح');
        } catch (Exception $ex) {
            DB::rollBack();
            session()->flash('error', 'حدث خطأ أثناء الحفظ ' . $ex->getMessage());
            return back();
        }
    }
}
