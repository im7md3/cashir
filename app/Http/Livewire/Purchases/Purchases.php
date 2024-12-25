<?php

namespace App\Http\Livewire\Purchases;

use App\Models\Purchase;
use Livewire\Component;

class Purchases extends Component
{
    public $purchase_item;

    public function render()
    {
        $purchases = Purchase::latest('id')->paginate(10);
        return view('livewire.purchases.purchases', compact('purchases'))->extends('layouts.app')->section('content');
    }

    public function itemId(Purchase $purchase)
    {
        $this->purchase_item = $purchase;
    }

    public function delete()
    {
        $this->purchase_item->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم الحذف بنجاح']);
    }
}
