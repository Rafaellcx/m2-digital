<?php

namespace App\Services\Contracts;

interface CityServiceContract
{
    public function index();

    public function show(int $id);

    public function store(array $fields);

    public function update(int $id, array $fields);

    public function destroy(int $id);
}
