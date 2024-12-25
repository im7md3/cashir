<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory, MultiBranch;

    protected $fillable = ['invoice_id', 'expense_id', 'purchase_id', 'amount', 'type', 'payment_method_id', 'user_id', 'user_session_id', 'branch_id'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
