<?php

namespace App\Services;

use App\Http\Helpers\JsonFormat;
use App\Http\Resources\ProductResource;
use App\Repositories\Contracts\ProductCampaignRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Services\Contracts\ProductServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductService implements ProductServiceContract
{
    protected $productRepository;
    protected $productCampaignRepository;

    /**
     * @param ProductRepositoryContract $productRepository
     * @param ProductCampaignRepositoryContract $productCampaignRepository
     */
    public function __construct(
        ProductRepositoryContract         $productRepository,
        ProductCampaignRepositoryContract $productCampaignRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productCampaignRepository = $productCampaignRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json(ProductResource::collection($this->productRepository->findAll()));
    }

    public function show(int $id): JsonResponse
    {
        $product = $this->productRepository->findById($id);

        if (!$product) {
            return JsonFormat::error('Product not found.');
        }

        return response()->json(new ProductResource($product));
    }

    public function store(array $fields): JsonResponse
    {
        try {
            $this->productRepository->save($fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Ops, Product was not created.');
        }

        return JsonFormat::success('Product was granted successfully.', [], 201);
    }

    public function update(int $id, array $fields): JsonResponse
    {
        try {
            $product = $this->productRepository->update($id, $fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Error trying to update data.');
        }

        if (!$product) {
            return JsonFormat::error('Product not found.');
        }

        return JsonFormat::success('Product was updated successfully.');
    }

    public function destroy(int $id): JsonResponse
    {
        /**
         * Verify if exists some product making reference in the products_campaign table.
         */
        $productsCampaign = $this->productCampaignRepository->findProducts($id);

        if (count($productsCampaign) > 0) {
            return JsonFormat::error(
                'The product cannot be deleted because it is being referenced in the products_campaign table.'
            );
        }

        $product = $this->productRepository->delete($id);

        if (!$product) {
            return JsonFormat::error('Product not found.');
        }

        return response()->json($product);
    }

}
