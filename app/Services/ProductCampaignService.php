<?php

namespace App\Services;

use App\Http\Helpers\JsonFormat;
use App\Http\Resources\ProductCampaignResource;
use App\Repositories\Contracts\ProductCampaignRepositoryContract;
use App\Services\Contracts\ProductCampaignServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductCampaignService implements ProductCampaignServiceContract
{
    protected $productCampaignRepository;

    /**
     * @param ProductCampaignRepositoryContract $productCampaignRepository
     */
    public function __construct(ProductCampaignRepositoryContract $productCampaignRepository)
    {
        $this->productCampaignRepository = $productCampaignRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json(ProductCampaignResource::collection($this->productCampaignRepository->findAll()));
    }

    public function show(int $id): JsonResponse
    {
        $productCampaign = $this->productCampaignRepository->findById($id);

        if (!$productCampaign) {
            return JsonFormat::error('Product Campaign not found.');
        }

        return response()->json(new ProductCampaignResource($productCampaign));
    }

    public function store(array $fields): JsonResponse
    {
        try {
            $this->productCampaignRepository->save($fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Ops, Product Campaign was not created.');
        }

        return JsonFormat::success('Product Campaign was granted successfully.', [], 201);
    }

    public function update(int $id, array $fields): JsonResponse
    {
        try {
            $productCampaign = $this->productCampaignRepository->update($id, $fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Error trying to update data.');
        }

        if (!$productCampaign) {
            return JsonFormat::error('Product Campaign not found.');
        }

        return JsonFormat::success('Product Campaign was updated successfully.');
    }

    public function destroy(int $id): JsonResponse
    {
        $productCampaign = $this->productCampaignRepository->delete($id);

        if (!$productCampaign) {
            return JsonFormat::error('Product Campaign not found.');
        }

        return response()->json($productCampaign);
    }

}
