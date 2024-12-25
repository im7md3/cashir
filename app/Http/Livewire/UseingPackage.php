<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class UseingPackage extends Component
{
    public function render()
    {
        $clients = Client::whereHas('package')->get();
        return view('livewire.useing-package', compact('clients'));
    }
}
