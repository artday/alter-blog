<?php

namespace App\Repositories\Contracts;

/**
 *  @method \Illuminate\Database\Eloquent\Collection|static[] all($columns = ['*']);
 *  @method \Illuminate\Contracts\Pagination\LengthAwarePaginator paginate(int $perPage=10, array $columns = ['*']);
 *  @method $this|\Illuminate\Database\Eloquent\Model create(array $properties);
 */

interface BlogPostRepository
{
    public function findBySlug($slug);
}