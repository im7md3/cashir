<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use App\Traits\livewireResource;
use Livewire\Component;
use Livewire\WithPagination;

class Branches extends Component
{
    use livewireResource;

    public $name;
    protected function rules()
    {
        return [
            'name' => ['string', 'required'],
        ];
    }
    public function render()
    {
        $branches = Branch::withCount('users')->latest('id')->paginate(10);
        return view('livewire.branches', compact('branches'));
    }
}
