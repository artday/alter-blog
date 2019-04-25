<?php

namespace App\Repositories\Contracts;

interface BlogCategoryRepository
{
    public function findBySlug($slug);
}