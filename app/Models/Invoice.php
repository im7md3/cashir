<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory, MultiBranch;

    protected $fillable = ['user_id', 'package_balance', 'package_id', 'client_id', 'date', 'price', 'discount', 'tax', 'total', 'payment_method', 'status', 'card', 'cash', 'refund', 'refund_status', 'rest', 'branch_id'];

    public function scopeUnpaid($q)
    {
        return $q->where('status', 'unpaid');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function items()
    {
        return $this->hasMany(InvoiceItems::class);
    }

    public function bonds()
    {
        return $this->hasMany(InvoiceBond::class, 'invoice_id');
    }

    public function payment_transactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }
}
