<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;
use Prgayman\Zatca\Facades\Zatca;
use Prgayman\Zatca\Utilis\QrCodeOptions; // Optional

class Show extends Component
{
    public $invoice, $qrCode;
    public function mount($id)
    {
        // $this->invoice = Invoice::with(['items', 'user', 'client'])->findOrFail($id);
        $invoice = Invoice::find($id);
        if(!$invoice){
            return;
        }
        $this->invoice = $invoice->load(['user', 'items', 'client']);
        $qrCodeOptions = new QrCodeOptions();
        $qrCodeOptions->format('svg');
        $qrCodeOptions->backgroundColor(255, 255, 255);
        $qrCodeOptions->color(0, 0, 0);
        $qrCodeOptions->size(125);
        $qrCodeOptions->margin(0);
        $qrCodeOptions->style('square', 0.5);
        $qrCodeOptions->eye('square');
        if (strlen(setting('tax_no')) == 15) {
            $this->qrCode = Zatca::sellerName(setting('website_name'))
                ->vatRegistrationNumber(setting('tax_no'))
                ->timestamp($this->invoice->created_at)
                ->totalWithVat($this->invoice->total)
                ->vatTotal($this->invoice->tax)
                ->toQrCode($qrCodeOptions);
        }
    }
    public function render()
    {

        return view('livewire.invoices.show');
    }
}
