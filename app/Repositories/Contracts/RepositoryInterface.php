<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all($columns = ['*']);
    public function find($id);
    public function findWhere($column, $value);
    public function findWhereFirst($column, $value);
    public function paginate($perPage = 10, $columns = ['*']);
    public function create(array $properties);
    public function update($id, array $properties);
    public function delete($id);
}