<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory, MultiBranch;

    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
