<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, MultiBranch;

    protected $fillable = ['name', 'department_id', 'price', 'quantity', 'allow_quantity', 'cover', 'saleprice', 'code', 'unit_id', 'barcode', 'opening_quantity', 'has_end_date', 'end_date', 'branch_id'];

    protected $appends = ['quantity'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function invoices()
    {
        return $this->hasMany(InvoiceItems::class, 'product_id');
    }

    public function offer()
    {
        return $this->hasOne(Offer::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function quantities()
    {
        return $this->hasMany(ProductQuantity::class);
    }

    public function getQuantityAttribute()
    {
        return $this->quantities()->where('type', 'charge')->sum('quantity') - $this->quantities()->where('type', 'expense')->sum('quantity') - $this->invoices()->sum('quantity');
    }
}
