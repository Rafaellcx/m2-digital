<?php

namespace App\Repositories\Contracts;

interface CityRepositoryContract
{
    public function findAll();

    public function findById(int $id);

    public function findGroup(int $groupId);

    public function save(array $fields);

    public function update(int $id, array $fields);

    public function delete(int $id);
}
