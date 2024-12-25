<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoicesExport implements FromView
{
    public $invoices;
    public function __construct($invoices)
    {
        $this->invoices = $invoices;
    }
    public function view(): View
    {

        return view('exports.invoices', [
            'invoices' => $this->invoices
        ]);
    }
}