<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Product;
use Livewire\Component;

class LabelMaker extends Component
{
    public $department_id, $products = [], $product_id, $product;
    public function render()
    {
        $departments = Department::get(['id','name']);
        return view('livewire.label-maker', compact('departments'));
    }

    public function updatedDepartmentId()
    {
        if ($this->department_id) {
            $this->products = Product::where('department_id', $this->department_id)->get();
        } else {
            $this->products = [];
        }
    }
    public function updatedProductId()
    {
        if ($this->product_id) {
            $this->product = Product::find($this->product_id);
        } else {
            $this->reset('product');
        }
    }
}
