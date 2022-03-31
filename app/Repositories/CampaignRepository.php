<?php

namespace App\Repositories;

use App\Models\Campaign;
use App\Repositories\Contracts\CampaignRepositoryContract;

class CampaignRepository implements CampaignRepositoryContract
{
    protected $model;

    /**
     * @param Campaign $model
     */
    public function __construct(Campaign $model)
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
