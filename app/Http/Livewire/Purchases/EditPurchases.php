<?php

namespace App\Http\Livewire\Purchases;

use App\Models\Branch;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductQuantity;
use App\Models\Purchase;
use App\Models\Supplier;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditPurchases extends Component
{
    public $purchase, $supplier_id, $branch_id, $amount = 0, $items = [], $invoice_data, $tax = 0, $total = 0, $date, $payments = [], $current_user_session;
    public $status, $paid, $rest;

    public function rules()
    {
        return [
            'supplier_id' => 'required',
            'branch_id' => setting('is_branches_active') ? 'required' : 'nullable',
            'amount' => 'required|numeric',
            'tax' => 'required|numeric',
            'total' => 'required|numeric',
            'date' => 'required|date',
            'items.*.product_id' => 'required',
            'items.*.quantity' => 'required|integer',
            'items.*.cost_price' => 'required|numeric',
            'items.*.sell_price' => 'required|numeric',
            'payments.*.payment_method_id' => 'required',
            'payments.*.user_session_id' => 'nullable',
            'payments.*.amount' => 'nullable',
            'paid' => 'required',
            'rest' => 'nullable',
            'status' => 'required',
        ];
    }
    public function mount(Purchase $purchase)
    {
        $this->purchase = $purchase;
        $this->supplier_id = $purchase->supplier_id;
        $this->branch_id = $purchase->branch_id;
        $this->amount = $purchase->amount;
        $this->tax = $purchase->tax;
        $this->total = $purchase->total;
        $this->date = $purchase->date;
        $this->paid = $purchase->paid;
        $this->rest = $purchase->rest;
        $this->status = $purchase->status;
        $this->items = $purchase->items()->get()->toArray();
        foreach ($purchase->payment_transactions()->get() as $payment) {
            $this->payments[] = [
                'payment_method_id' => $payment->payment_method->id,
                'payment_method_name' => $payment->payment_method->name,
                'type' => $payment->type,
                'amount' => $payment->amount,
                'user_id' => $payment->user_id,
                'user_session_id' => $payment->user_session_id,
            ];
        }
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

    public function render()
    {
        $branches = Branch::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $payment_methods = PaymentMethod::where('id', auth()->user()->id)->OrWhere('is_cash', 0)->where('status', 1)->get();
        $this->current_user_session = auth()->user()->user_sessions()->whereNull('end_time')->where('date', date('Y-m-d'))->latest()->first();
        return view('livewire.purchases.form', compact('branches', 'suppliers', 'products', 'payment_methods'))->extends('layouts.app')->section('content');
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

        $this->total =  round($this->tax + $this->amount, 2);
        $this->paid = round(collect($this->payments)->sum('amount'), 2);
        $this->rest = $this->total - $this->paid;
        $this->status = $this->getStatus();

        if (collect($this->payments)->sum('amount') > $this->total) {
            foreach ($this->payment as $key => $payment_method) {
                $this->payments[$key]['amount'] = 0;
                $this->reset('paid', 'rest');
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

    public function save()
    {
        $data = $this->validate();

        try {
            DB::beginTransaction();

            $this->purchase->update($data);
            $this->purchase->branch_id = $this->branch_id;
            $this->purchase->save();
            $this->purchase->items()->delete();
            $this->purchase->product_quantities()->delete();
            $this->purchase->payment_transactions()->delete();
            $this->purchase->items()->createMany($this->items);

            foreach ($this->items as $item) {

                ProductQuantity::create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'type' => 'charge',
                    'purchase_id' => $this->purchase->id
                ]);

                $product = Product::find($item['product_id']);
                $product->update(['saleprice' => $item['sell_price']]);
            }


            if (count($this->payments) > 0) {
                $this->purchase->payment_transactions()->createMany($this->payments);
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
