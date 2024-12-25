<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];
    public function created_at()
    {
        return $this->created_at->format('Y-m-d') ;
    }
}
