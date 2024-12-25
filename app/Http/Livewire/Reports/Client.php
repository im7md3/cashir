<?php

namespace App\Http\Livewire\Reports;

use App\Models\Client as ModelsClient;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class Client extends Component
{
    use WithPagination;
    public $from, $to, $status, $name, $phone, $pay_method, $client;
   

    protected $paginationTheme = 'bootstrap';

    public function get_client()
    {
        $this->client = ModelsClient::where('phone', $this->phone)->first();

        if ($this->client) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم إيجاد بيانات العميل']);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'لا يوجد عميل']);
        }
    }

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }

    public function render()
    {

        $invoices = [];
        if ($this->client) {
            $invoices = $this->client->invoices()->where(function ($q) {
                $this->between($q);
                if ($this->pay_method == 'cash') {
                    $q->where('cash', '!=', 0);
                } else {
                    $q->where('card', '!=', 0);
                }
            })->latest()->paginate(10);
        }

        return view('livewire.reports.client', compact('invoices'));
    }
}
