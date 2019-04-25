<?php

namespace App\Repositories\Eloquent;

use App\Models\BlogCategory;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\BlogCategoryRepository;

class EloquentBlogCategoryRepository extends RepositoryAbstract implements BlogCategoryRepository
{
    public function entity()
    {
        return BlogCategory::class;
    }

    public function findBySlug($slug)
    {
        return $this->findWhereFirst('slug', $slug);
    }
}