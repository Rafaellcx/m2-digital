<?php

namespace App\Repositories;

use App\Models\Group ;
use App\Repositories\Contracts\GroupRepositoryContract;

class GroupRepository implements GroupRepositoryContract
{
    protected $model;

    /**
     * @param Group $model
     */
    public function __construct(Group $model)
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

    public function findCampaignId(int $campaignId)
    {
        return $this->model->where('campaign_id', $campaignId)->first();
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
