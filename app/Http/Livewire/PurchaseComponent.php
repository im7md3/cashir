<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethod;
use App\Models\Purchase;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\livewireResource;

class PurchaseComponent extends Component
{
    public $name;
    public $amount;
    public $status = 0;
    public $id;
    public $amountwithtax;
    public $amountwithnotax;
    public $total;
    public $tax;
    public $sumtax;
    public $sumamount;
    public $totalpurchase;
    public $current_user_session;
    public $payments = [];


    use WithPagination, livewireResource;
    protected $listeners = [
        'update' => 'mount'
    ];
    public function mount()
    {
        $this->amountwithnotax = Purchase::whereStatus('0')->sum('amount');
        $this->amountwithtax = Purchase::whereStatus('1')->sum('amount');
        $this->sumamount = Purchase::sum('amount');
        $this->sumtax = $this->amountwithtax * setting('tax') / 100;
        $this->total = $this->amountwithtax  + ($this->amountwithtax  * setting('tax') / 100);
        // $this->totalpurchase = $this->sumamount  + ( $this->amountwithtax  * setting('tax')/100);
        $this->totalpurchase = $this->amountwithtax + ($this->amountwithtax  * setting('tax') / 100);
        // $this->total = setting('tax');
        $this->tax = setting('tax');
    }
    protected function rules()
    {
        return [
            'name'      => 'string|required',
            'amount'    => 'required|numeric',
            'payments' => 'required',
            'payments.*.payment_method_id' => 'required',
            'payments.*.user_session_id' => 'required',
            'payments.*.amount' => 'required|numeric|gt:0|lte:amount',
            // 'status'    => 'boolean',
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $purchases = Purchase::latest('id')->paginate(10);
        $payment_methods = PaymentMethod::where('id', auth()->user()->id)->OrWhere('is_cash', 0)->where('status', 1)->get();
        $this->current_user_session = auth()->user()->user_sessions()->whereNull('end_time')->where('date', date('Y-m-d'))->latest()->first();
        return view('livewire.purchase-component', compact('purchases', 'payment_methods'));
    }
    public function delete(Purchase $purchase)
    {
        $purchase->delete();
        $this->emit('update');
        // session()->flash('success', ' تم الحذف بنجاح');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم الحذف بنجاح']);
    }

    public function store()
    {
        $data = $this->validate();
        $purchase = Purchase::create([
            "name"   => $this->name,
            "amount" => $this->amount,
            "status" => $this->status,
        ]);

        if (count($this->payments) > 0) {
            $purchase->payment_transactions()->createMany($this->payments);
        }


        // session()->flash('success', ' تم الاضافه بنجاح');
        $this->emit('update');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم الحفظ بنجاح']);
    }

    public function edit($id)
    {
        $purchase =  Purchase::find($id);
        $this->id = $purchase->id;
        $this->name = $purchase->name;
        $this->amount = $purchase->amount;
        $this->status = $purchase->status;
        $this->payments = $purchase->payment_transactions()->get()->toArray();
    }
    public function update($id)
    {
        $data = $this->validate();
        $purchase =  Purchase::find($id);
        $purchase->update([
            "name"   => $this->name,
            "amount" => $this->amount,
            "status" => $this->status,
        ]);
        $purchase->payment_transactions()->delete();
        if (count($this->payments) > 0) {
            $purchase->payment_transactions()->createMany($this->payments);
        }
        // session()->flash('success', ' تم التعديل بنجاح');
        $this->emit('update');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم التعديل بنجاح']);
    }

    public function addPayment()
    {
        $this->payments[] = [
            'payment_method_id' => '',
            'amount' => '',
            'type' => 'out',
            'user_id' => auth()->user()->id,
            'user_session_id' => $this->current_user_session?->id,
        ];
    }

    public function removePayment($index)
    {
        unset($this->payments[$index]);
        $this->payments = array_values($this->payments);
    }
}
