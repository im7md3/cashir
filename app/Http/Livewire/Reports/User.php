<?php

namespace App\Http\Livewire\Reports;

use App\Exports\UserReportExport;
use App\Models\Invoice;
use App\Models\PaymentMethod;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class User extends Component
{

    use WithPagination;
    public $from, $to, $status, $user_id, $pay_method, $user;
    // public $total,$totalcash,$totalcard;
    // public function mount(){
    //     $this->total     = Invoice::sum('total');
    //     $this->totalcash = Invoice::sum('cash');
    //     $this->totalcard = Invoice::sum('card');
    // }

    protected $paginationTheme = 'bootstrap';


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
        if ($this->user_id) {
            $invoices = Invoice::where('user_id', $this->user_id)->where(function ($q) {
                $this->between($q);
            })->latest()->paginate(10);
        }

        $payment_methods = PaymentMethod::all();

        return view('livewire.reports.user', compact('invoices', 'payment_methods'));
    }

    public function export()
    {
        $invoices = [];
        if ($this->user_id) {
            $invoices = Invoice::where('user_id', $this->user_id)->where(function ($q) {
                $this->between($q);
            })->latest()->get();
        }

        return Excel::download(new UserReportExport($invoices), 'users_report' . time() . '.xlsx');
    }
}
