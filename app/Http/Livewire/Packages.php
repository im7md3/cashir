<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use App\Models\Package;
use App\Traits\livewireResource;
use Livewire\Component;
use Livewire\WithPagination;

class Packages extends Component
{
    use livewireResource;

    public $name,$price,$rate;
    protected function rules(){
        return [
            'name' => ['string','required'],
            'price' => ['required'],
            'rate' => ['required'],
        ];
    }

    public function beforeCreate()
    {
        $this->data['total_price'] = $this->data['price'] + ($this->data['price'] * ($this->data['rate'] / 100) );
    }

    public function beforeUpdate()
    {
        $this->data['total_price'] = $this->data['price'] + ($this->data['price'] * ($this->data['rate'] / 100) );
    }
    public function render()
    {
        $packages=Package::latest('id')->paginate(10);
        return view('livewire.packages',compact('packages'));
    }
}
