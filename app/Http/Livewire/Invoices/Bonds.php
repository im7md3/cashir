<?php

namespace App\Http\Livewire\Invoices;

use App\Models\InvoiceBond;
use Livewire\Component;
use Livewire\WithPagination;

class Bonds extends Component
{
    public $invoice_id, $amount, $bond, $client, $rest, $invoice, $status, $user_id, $invoice_rest;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'invoice_id' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required',
        ];
    }

    public function edit(InvoiceBond $bond)
    {
        $this->invoice_id = $bond->invoice_id;
        $this->amount = $bond->amount;
        $this->client = $this->invoice->client->name;
        $this->status = $bond->status;
        $this->bond = $bond;
    }
    public function save()
    {
        $data = $this->validate();
        $data['user_id'] = $this->user_id;
        if ($this->amount > $this->invoice->rest) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'المبلغ المكتوب أكبر من المبلغ المتبقي للفاتورة']);
        } else {
            if ($this->status == 'creditor') {
                $status = '';
                if ($this->invoice->rest - $this->amount <= 0) {
                    $status = 'paid';
                } else {
                    $status = 'partially_paid';
                }
                $this->invoice->update([
                    'rest' => $this->invoice->rest - $this->amount,
                    'status' => $status
                ]);
            } else {
                $this->invoice->update([
                    'rest' => $this->invoice->rest + $this->amount,
                    'status' => 'Partially retrieved'
                ]);
            }
            $data['rest'] = $this->invoice->rest;
            if ($this->bond) {
                $this->invoice->update([
                    'rest' => $this->invoice->rest + $this->amount,
                ]);

                $this->invoice->update([
                    'rest' => $this->invoice->rest - $this->rest,
                ]);

                $this->bond->update($data);
            } else {
                InvoiceBond::create($data);
            }
        }
        $this->reset('amount');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    public function delete(InvoiceBond $bond)
    {
        $this->invoice->update([
            'rest' => $this->invoice->rest + $bond->amount,
            'status' => 'partially_paid'
        ]);
        $bond->delete();

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function mount()
    {
        $this->invoice_id = $this->invoice->id;
        $this->user_id = auth()->id();
        $this->client = $this->invoice->client?->name;
        $this->status = 'creditor';
    }
    public function render()
    {
        $this->invoice_rest = $this->invoice->rest;
        $bonds = $this->invoice->bonds()->latest('id')->paginate(10);
        return view('livewire.invoices.bonds', compact('bonds'));
    }
}
