<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Package;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Traits\livewireResource;

class Suppliers extends Component
{

    use WithPagination, livewireResource;

    public $name, $phone, $suuplier, $strret, $searchphone, $company,$tax_number;


    protected function rules()
    {
        return [
            'name' => ['string', 'required'],
            'phone' => [$this->obj ? Rule::unique('suppliers')->ignore($this->obj->id) : 'unique:suppliers', 'required'],
            'strret' => 'nullable',
            'company' => 'nullable',
            'tax_number' => 'nullable',

        ];
    }

    public function render()
    {
        $suppliers = Supplier::where(function ($q) {
            if ($this->searchphone) {
                $q->where('phone', 'LIKE', "%$this->searchphone%");
            }
        })->latest()->paginate(10);
        return view('livewire.suppliers', compact('suppliers'));
    }
}
