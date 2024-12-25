<?php

namespace App\Http\Livewire\Invoices;

use App\Http\Livewire\Reports\User;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\PaymentMethod;
use App\Models\User as ModelsUser;
use Livewire\Component;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    public $filter_status, $from, $to, $searchemployee, $searchinvoiveno, $refund, $refund_status, $package_client;
    public $total, $totalcash, $totalcard, $user_id;
    public $queryString = [
        'package_client'
    ];
    public function mount()
    {
        $this->total     = Invoice::sum('total');
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
    public function retrieved(Invoice $invoice)
    {
        $this->validate([
            'refund' => 'required|numeric',
            'refund_status' => 'required|in:creditor,debtor',
        ]);

        $total = 0;
        if ($this->refund_status == 'creditor') {
            $total = $invoice->total + $this->refund;
        } else {
            $total = $invoice->total  - $this->refund;
        }

        $invoice->update([
            'total' => $total,
            'refund' => $this->refund,
            'refund_status' => $this->refund_status,
            'status' => 'retrieved'
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم استرجاع الفاتورة بنجاح']);
    }
    public function delete(Invoice $invoice)
    {
        $invoice->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم حذف الفاتورة بنجاح']);
    }
    public function render()
    {

        $invoices = Invoice::with(['user', 'client'])->where(function ($q) {
            $this->between($q);
            if ($this->filter_status) {
                $q->where('status', $this->filter_status);
            }
            if ($this->user_id) {
                $q->where('user_id', $this->user_id);
            }
            if ($this->searchinvoiveno) {
                $q->where('id', 'like', '%' . $this->searchinvoiveno . '%');
            }
            if ($this->searchemployee) {
                if ($this->searchemployee == 'unknown') {
                    $q->whereNull('client_id');
                } else {
                    $q->where('client_id', $this->searchemployee);
                }
            }
            if ($this->package_client) {
                $q->where('client_id', $this->package_client)->where('package_balance', '>', 0);
            }
        })->latest('id')->paginate(10);


        $packageClient = $this->package_client ? Client::find($this->package_client) : null;
        $users = ModelsUser::all();
        $payment_methods = PaymentMethod::all();
        return view('livewire.invoices.index', compact('invoices', 'packageClient', 'users', 'payment_methods'));
    }


    public function export()
    {
        return Excel::download(new InvoicesExport(Invoice::get()), 'invoices' . time() . '.xlsx');
    }
}