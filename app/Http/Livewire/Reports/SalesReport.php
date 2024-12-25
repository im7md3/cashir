<?php

namespace App\Http\Livewire\Reports;

use App\Models\Invoice;
use App\Models\PaymentMethod;
use Livewire\Component;

class SalesReport extends Component
{
    public $to, $from;

    // public $paid_invoices = 1, $unpaid_invoices = 1, $tax_invoices =1 , $card_invoices=1, $cash_invoices=1;

    public $type = [
        'paid_invoices' => 1,
        'unpaid_invoices' => 1,
        'tax_invoices' => 1,
        'card_invoices' => 1,
        'cash_invoices' => 1
    ];
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
        })->get();

        if (isset($this->type['unpaid_invoices'])) {
            $this->type['unpaid_invoices'] = $invoices->where('status', 'unpaid')->sum('total');
        }

        if (isset($this->type['paid_invoices'])) {
            $this->type['paid_invoices'] = $invoices->where('status', 'paid')->sum('total');
        }

        if (isset($this->type['cash_invoices'])) {
            $this->type['cash_invoices'] =  $invoices->sum('cash');
        }

        if (isset($this->type['card_invoices'])) {
            $this->type['card_invoices'] =  $invoices->sum('card');
        }
        if (setting('active_tax')) {
            if (isset($this->type['tax_invoices'])) {
                $this->type['tax_invoices'] =  $invoices->sum('tax');
            }
        }

        // $unpaid = $this->unpaid_invoices ? $invoices->where('status', 'unpaid')->sum('total') : 0;
        // $paid = $this->paid_invoices ? $invoices->where('status', 'paid')->sum('total') : 0;
        // $cash = $this->cash_invoices ? $invoices->sum('cash') : 0;
        // $card = $this->card_invoices ? $invoices->sum('card') : 0;
        // $tax = $this->tax_invoices ? $invoices->sum('tax') : 0;


        $payment_methods = PaymentMethod::all();

        return view('livewire.reports.sales-report', compact('invoices', 'payment_methods'));
    }

    public function changeType($value)
    {
        unset($this->type[$value]);
    }
}
