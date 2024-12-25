<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory, MultiBranch;

    protected $fillable = ['name', 'account_no', 'status', 'default_payment', 'is_cash', 'branch_id'];

    public function payment_transactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
}
