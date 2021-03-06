<?php

namespace App\Repositories;

use App\Repositories\Exceptions\NoEntityDefined;
use App\Repositories\Criteria\CriteriaInterface;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class RepositoryAbstract implements RepositoryInterface, CriteriaInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    protected $entity;

    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->entity->get($columns);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function find($id)
    {
        return $this->modelOrFail($this->entity->find($id));
    }

    /**
     * @param $column
     * @param $value
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findWhere($column, $value)
    {
        return $this->entity->where($column, $value)->get();
    }

    /**
     * @param $column
     * @param $value
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function findWhereFirst($column, $value)
    {
//        return $this->entity->where($column, $value)->firstOrFail();
        return $this->modelOrFail($this->entity->where($column, $value)->first());
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 10, $columns = ['*'])
    {
        return $this->entity->paginate($perPage, $columns);
    }

    /**
     * @param array $properties
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $properties)
    {
        return $this->entity->create($properties);
    }

    /**
     * @param $id
     * @param array $properties
     * @return bool
     */
    public function update($id, array $properties)
    {
        return $this->find($id)->update($properties);
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * @param array ...$criteria
     * @return $this
     */
    public function withCriteria(...$criteria)
    {
        $criteria = array_flatten($criteria);

        foreach ($criteria as $criterion) {
            $this->entity = $criterion->apply($this->entity);
        }
        return $this;
    }

    /**
     * @param $model
     * @return mixed
     */
    protected function modelOrFail($model)
    {
        if (!$model) {
            //TODO: create custom ModelNotFoundException
            throw (new ModelNotFoundException)->setModel(get_class($this->entity->getModel()));
        }
        return $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     * @throws NoEntityDefined
     */
    protected function resolveEntity()
    {
        if (!method_exists($this, 'entity')){
            throw new NoEntityDefined();
        }
        return app()->make($this->entity());
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    /*public function resolveRouteBinding($value)
    {
//        dd($this->find($value));
        dump($value);
        return $value;
    }*/
}