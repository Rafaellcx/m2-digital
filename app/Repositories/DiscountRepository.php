<?php

namespace App\Repositories;

use App\Models\Discount;
use App\Repositories\Contracts\DiscountRepositoryContract;

class DiscountRepository implements DiscountRepositoryContract
{
    protected $model;

    /**
     * @param Discount $model
     */
    public function __construct(Discount $model)
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
