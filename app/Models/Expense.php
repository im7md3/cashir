<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory, MultiBranch;

    protected $fillable = ['name', 'amount', 'expense_category_id', 'expense_subcategory_id', 'branch_id'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function payment_transactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }
}
