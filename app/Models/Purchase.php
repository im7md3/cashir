<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory, MultiBranch;

    protected $fillable = ['supplier_id', 'branch_id', 'amount', 'tax', 'total', 'date', 'barcode',
        'paid','status','rest'

    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function payment_transactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    public function product_quantities()
    {
        return $this->hasMany(ProductQuantity::class, 'purchase_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
