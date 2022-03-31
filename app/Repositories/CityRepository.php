<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Contracts\CityRepositoryContract;

class CityRepository implements CityRepositoryContract
{
    protected $model;

    /**
     * @param City $model
     */
    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function findGroup(int $groupId)
    {
        return $this->model->where('group_id', $groupId)->first();
    }

    public function save(array $fields)
    {
        return $this->model->create($fields);
    }

    public function update(int $id, array $fields)
    {
        return $this->model->where('id', $id)->update($fields);
    }

    public function delete(int $id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
