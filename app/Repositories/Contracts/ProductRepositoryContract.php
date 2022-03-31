<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryContract
{
    public function findAll();

    public function findById(int $id);

    public function findDiscountId(int $id);

    public function save(array $fields);

    public function update(int $id, array $fields);

    public function delete(int $id);
}
