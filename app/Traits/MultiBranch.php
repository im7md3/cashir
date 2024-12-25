<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait MultiBranch
{
    public static function bootMultiBranch()
    {
        if (setting('is_branches_active')) {
            if (auth()->check()) {
                if (auth()->user()->branch_id) {
                    static::creating(function ($model) {
                        $model->branch_id = auth()->user()->branch_id;
                    });

                    static::addGlobalScope('branch_id', function (Builder $builder) {
                        return $builder->where('branch_id', auth()->user()->branch_id);
                    });
                }
            }
        }
    }
}
