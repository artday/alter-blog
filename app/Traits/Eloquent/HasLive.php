<?php

namespace App\Traits\Eloquent;

use Illuminate\Database\Eloquent\Builder;

trait HasLive
{
    public function scopeLive(Builder $builder)
    {
        return $builder->where('is_published', true);
    }
}