<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\PaymentMethod;
use App\Traits\livewireResource;
use Livewire\Component;
use Livewire\WithPagination;

class Expenses extends Component
{
    use livewireResource, WithPagination;

    public $expense_category_id, $expense_subcategory_id, $name, $amount, $payments = [], $current_user_session;

    protected function rules()
    {
        return [
            'name' => ['required'],
            'amount' => ['required', 'numeric'],
            'expense_category_id' => ['required'],
            'expense_subcategory_id' => ['nullable'],
            'payments' => 'required',
            'payments.*.payment_method_id' => 'required',
            'payments.*.amount' => 'required|numeric|gt:0|lte:amount',
        ];
    }

    public function render()
    {
        $expense_categories = ExpenseCategory::all();
        $expenses = Expense::latest()->paginate(10);
        $payment_methods = PaymentMethod::where('id', auth()->user()->id)->OrWhere('is_cash', 0)->where('status', 1)->get();
        $this->current_user_session = auth()->user()->user_sessions()->whereNull('end_time')->where('date', date('Y-m-d'))->latest()->first();
        return view('livewire.expenses', compact('expenses', 'payment_methods', 'expense_categories'));
    }

    public function whileEditing()
    {
        $this->payments = $this->obj->payment_transactions()->get()->toArray();
    }

    public function beforeUpdate()
    {
        $this->obj->payment_transactions()->delete();
    }

    public function beforeSubmit()
    {
        unset($this->data['payments']);
    }

    public function afterSubmit()
    {
        if (count($this->payments) > 0) {
            $this->obj->payment_transactions()->createMany($this->payments);
        }
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
