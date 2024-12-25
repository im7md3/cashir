<?php

namespace App\Http\Livewire;

use App\Models\Unit;
use App\Traits\livewireResource;
use Livewire\Component;

class Units extends Component
{
    use livewireResource;

    public $name;

    protected function rules()
    {
        return [
            'name' => ['required'],
        ];
    }
    public function render()
    {
        $units=Unit::latest('id')->paginate(10);
        return view('livewire.units',compact('units'));
    }
}
