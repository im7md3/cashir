<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Client;
use Livewire\Component;

class Free extends Component
{
    public $search;
    public function free(Client $client){
        if($client->invoices_number>=10){
            $client->update(['invoices_number'=>0]);
        }
        if($client->invoices_amount>=setting('amount_free_invoice')){
            $client->update(['invoices_amount'=>0]);
        }
        $client->update(['free_count'=>++$client->free_count]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تمت العملية بنجاح']);
    }
    public function render()
    {
        $clients=Client::Free()->orWhere('free_count','>',0)->where(function($q){
            if($this->search){
                $q->where('name','LIKE',"%".$this->search."%")->orWhere('phone',"LIKE","%".$this->search."%");
            }
        })->paginate();
        return view('livewire.invoices.free',compact('clients'));
    }
}
