<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory, MultiBranch;

    protected $fillable = ['name', 'phone', 'social_situation', 'invoices_number', 'invoices_amount', 'free_count', 'package_id', 'branch_id'];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function scopeFree($query)
    {
        return $query->where(function ($q) {
            $q->where('invoices_number', '>=', 10);
            if (setting('amount_free_invoice')) {
                $q->orWhere('invoices_amount', '>=', setting('amount_free_invoice'));
            }
        });
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
