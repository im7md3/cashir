<?php

namespace App\Http\Livewire\Reports;

use App\Models\Branch;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\PaymentMethod;
use App\Models\Purchase;
use Livewire\Component;

class General extends Component
{
    public $to, $from, $branch_id;

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
        $invoices = Invoice::where(function ($q) {
            $this->between($q);
            if ($this->branch_id) {
                $q->where('branch_id', $this->branch_id);
            }
        })->get();

        $expenses = Expense::where(function ($q) {
            $this->between($q);
            if ($this->branch_id) {
                $q->where('branch_id', $this->branch_id);
            }
        })->get();

        $purchases = Purchase::where(function ($q) {
            $this->between($q);
            if ($this->branch_id) {
                $q->where('branch_id', $this->branch_id);
            }
        })->get();


        $payment_methods = PaymentMethod::all();
        $branches = Branch::all();
        return view('livewire.reports.general', compact('invoices', 'expenses', 'purchases', 'payment_methods', 'branches'));
    }
}
