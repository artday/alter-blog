<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\UserRepository;

class EloquentUserRepository extends RepositoryAbstract implements UserRepository
{
    public function entity()
    {
        return User::class;
    }

    /*

    public function all()
    {
        return User::all();
    }*/
}