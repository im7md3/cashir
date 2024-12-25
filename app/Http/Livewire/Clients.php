<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Package;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Traits\livewireResource;

class Clients extends Component
{
    use WithPagination, livewireResource;

    public $name, $phone, $client, $social_situation, $searchphone, $package_id, $filter_package;


    protected function rules()
    {
        return [
            'name' => ['required', 'regex:/^[\p{L}\s]+$/u'],
            'phone' => ['required', 'numeric', $this->obj ? Rule::unique('clients')->ignore($this->obj->id) : 'unique:clients'],
            'social_situation' => 'nullable',
            'package_id' => 'nullable',
        ];
    }

    public function beforeSubmit()
    {
        if ($this->package_id == '') {
            $this->data['package_id'] = null;
        }
        if ($this->social_situation == '') {
            $this->data['social_situation'] = null;
        }
    }

    public function mount()
    {

        if (request('package_id')) {
            $this->filter_package = request('package_id');
        }
    }
    public function render()
    {
        $clients = Client::where(function ($q) {
            if ($this->searchphone) {
                $q->where('phone', 'LIKE', "%$this->searchphone%");
            }
            if ($this->filter_package) {
                $q->where('package_id', $this->filter_package);
            }
        })->latest()->paginate(10);
        $packages = Package::latest()->get();
        return view('livewire.clients', compact('clients', 'packages'));
    }
}
