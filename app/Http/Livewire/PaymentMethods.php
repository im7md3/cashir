<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethod;
use App\Traits\livewireResource;
use Livewire\Component;

class PaymentMethods extends Component
{
    use livewireResource;

    public $name, $account_no, $status = true, $is_cash = false, $default_payment = false;

    protected function rules()
    {
        return [
            'name' => ['required'],
            'account_no' => ['nullable', 'unique:payment_methods,account_no,' . $this->obj?->id],
            'status' => ['boolean'],
            'is_cash' => ['boolean'],
            'default_payment' => ['boolean'],
        ];
    }

    public function render()
    {
        $payment_methods = PaymentMethod::with(['users'])->paginate(10);
        return view('livewire.payment-methods', compact('payment_methods'))->extends('layouts.app')->section('content');
    }
}
