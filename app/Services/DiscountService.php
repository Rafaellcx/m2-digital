<?php

namespace App\Services;

use App\Http\Helpers\JsonFormat;
use App\Http\Resources\DiscountResource;
use App\Repositories\Contracts\DiscountRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Services\Contracts\DiscountServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class DiscountService implements DiscountServiceContract
{
    protected $discountRepository;
    protected $productRepository;

    /**
     * @param DiscountRepositoryContract $discountRepository
     * @param ProductRepositoryContract $productRepository
     */
    public function __construct(
        DiscountRepositoryContract $discountRepository,
        ProductRepositoryContract $productRepository
    )
    {
        $this->discountRepository = $discountRepository;
        $this->productRepository = $productRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json(DiscountResource::collection($this->discountRepository->findAll()));
    }

    public function show(int $id): JsonResponse
    {
        $discount = $this->discountRepository->findById($id);

        if (!$discount) {
            return JsonFormat::error('Discount not found.');
        }

        return response()->json(new DiscountResource($discount));
    }

    public function store(array $fields): JsonResponse
    {
        try {
            $this->discountRepository->save($fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Ops, Discount was not created.');
        }

        return JsonFormat::success('Discount was granted successfully.', [], 201);
    }

    public function update(int $id, array $fields): JsonResponse
    {
        try {
            $discount = $this->discountRepository->update($id, $fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Error trying to update data.');
        }

        if (!$discount) {
            return JsonFormat::error('Discount not found.');
        }

        return JsonFormat::success('Discount was updated successfully.');
    }

    public function destroy(int $id): JsonResponse
    {
        /**
         * Verify if exists some discount making reference in the products table.
         */
        $product = $this->productRepository->findDiscountId($id);

        if ($product) {
            return JsonFormat::error(
                'The discount cannot be deleted because it is being referenced to the product ' . $product->id . ' - ' .$product->name . '.'
            );
        }

        $discount = $this->discountRepository->delete($id);

        if (!$discount) {
            return JsonFormat::error('Discount not found.');
        }

        return response()->json($discount);
    }

}
