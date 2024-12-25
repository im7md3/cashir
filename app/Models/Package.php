<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory, MultiBranch;

    protected $guarded = [];

    public function clients()
    {
        return $this->hasMany(Client::class, 'package_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
