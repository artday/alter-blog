<?php

namespace App\Repositories\Eloquent\Criteria;

use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Criteria\CriterionInterface;

class LatestFirst implements CriterionInterface
{
    /**
     * @param Builder $entity
     * @return mixed
     */
    public function apply($entity)
    {
        return $entity->latest();
    }
}