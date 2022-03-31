<?php

namespace App\Repositories\Contracts;

interface ProductCampaignRepositoryContract
{
    public function findAll();

    public function findById(int $id);

    public function findProducts(int $productId);

    public function findCampaign(int $campaignId);

    public function save(array $fields);

    public function update(int $id, array $fields);

    public function delete(int $id);
}
