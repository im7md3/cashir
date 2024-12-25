<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    use HasFactory, MultiBranch;

    protected $fillable = ['user_id', 'date', 'start_time', 'end_time', 'start_amount', 'end_amount', 'branch_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
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
