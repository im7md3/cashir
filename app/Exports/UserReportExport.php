<?php

namespace App\Exports;

use App\Models\PaymentMethod;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserReportExport implements FromView
{
    public $invoices;

    public function __construct($invoices)
    {
        $this->invoices = $invoices;
    }
    public function view(): View
    {
        $payment_methods = PaymentMethod::all();
        return view('exports.reports.users', [
            'invoices' => $this->invoices,
            'payment_methods' => $payment_methods,
        ]);
    }
}
