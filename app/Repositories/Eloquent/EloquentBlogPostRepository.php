<?php

namespace App\Repositories\Eloquent;

use App\Models\BlogPost;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\BlogPostRepository;

class EloquentBlogPostRepository extends RepositoryAbstract implements BlogPostRepository
{
    /*public function __construct()
    {
        parent::__construct();
    }*/

    public function entity()
    {
        return BlogPost::class;
    }

    /*public function allLive($paginate = 10)
    {
        return $this->entity->where('is_published', true)->paginate($paginate);
    }

    public function allLiveLatest($paginate = 10)
    {
        return $this->entity->where('is_published', true)->latest()->paginate($paginate);
    }*/
}