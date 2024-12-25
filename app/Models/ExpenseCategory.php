<?php

namespace App\Models;

use App\Traits\MultiBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory, MultiBranch;

    protected $fillable = ['name', 'parent', 'branch_id'];

    public function main()
    {
        return $this->belongsTo(ExpenseCategory::class, 'parent');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    public function kids()
    {
        return $this->hasMany(ExpenseCategory::class, 'parent');
    }
}
