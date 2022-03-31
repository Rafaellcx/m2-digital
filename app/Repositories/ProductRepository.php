<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;

class ProductRepository implements ProductRepositoryContract
{
    protected $model;

    /**
     * @param Product $model
     */
    public function __construct(Product $model)
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

    public function findDiscountId(int $id)
    {
        return $this->model->where('discount_id', $id)->first();
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
