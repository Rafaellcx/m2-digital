<?php

namespace App\Repositories;

use App\Models\ProductCampaign;
use App\Repositories\Contracts\ProductCampaignRepositoryContract;

class ProductCampaignRepository implements ProductCampaignRepositoryContract
{
    protected $model;

    /**
     * @param ProductCampaign $model
     */
    public function __construct(ProductCampaign $model)
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

    public function findProducts(int $productId)
    {
        return $this->model->where('product_id', $productId)->get();
    }

    public function findCampaign(int $campaignId)
    {
        return $this->model->where('campaign_id', $campaignId)->get();
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
