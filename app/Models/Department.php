<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent', 'branch_id', 'image'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function main()
    {
        return $this->belongsTo(Department::class, 'parent');
    }
    public function kids()
    {
        return $this->hasMany(Department::class, 'parent');
    }
}
