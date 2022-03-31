<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCampaignRequest;
use App\Http\Requests\UpdateProductCampaignRequest;
use App\Services\Contracts\ProductCampaignServiceContract;
use Illuminate\Http\JsonResponse;

class ProductCampaignController extends Controller
{
    public $productCampaignService;

    public function __construct(ProductCampaignServiceContract $productCampaignService)
    {
        $this->productCampaignService = $productCampaignService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */

    /**
     * List Products Campaign
     * @OA\Get (
     *     path="/api/product-campaign/all",
     *     tags={"Products Campaign"},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="product_id",
     *                         type="number",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="product_name",
     *                         type="string",
     *                         example="example product name"
     *                     ),
     *                     @OA\Property(
     *                         property="campaign_id",
     *                         type="number",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="campaign_name",
     *                         type="string",
     *                         example="example campaign name"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function index(): JsonResponse
    {
        return $this->productCampaignService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductCampaignRequest $request
     * @return JsonResponse
     */

    /**
     * Create Group
     * @OA\Post (
     *     path="/api/product-campaign/store",
     *     tags={"Products Campaign"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                     @OA\Property(
     *                         property="product_id",
     *                         type="number",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="campaign_id",
     *                         type="number",
     *                         example=1
     *                     ),
     *                 ),
     *                 example={
     *                     "product_id":1,
     *                     "campaign_id":1,
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="type", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="Product Campaign was updated successfully."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="type", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Product Campaign not found."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Exception",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Error trying to update data."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      )
     * )
     */

    public function store(StoreProductCampaignRequest $request): JsonResponse
    {
        return $this->productCampaignService->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */

    /**
     * Get Product Campaign Details
     * @OA\Get (
     *     path="/api/product-campaign/find/{id}",
     *     tags={"Products Campaign"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="product_id", type="number", example=1),
     *              @OA\Property(property="product_name", type="string", example="example product name"),
     *              @OA\Property(property="campaign_id", type="number", example=1),
     *              @OA\Property(property="campaign_name", type="string", example="example campaign name"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="failed"),
     *              @OA\Property(property="message", type="string", example="Product Campaign not found."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     * )
     */

    public function show($id): JsonResponse
    {
        return $this->productCampaignService->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param UpdateProductCampaignRequest $request
     * @return JsonResponse
     */

    /**
     * Update Product Campaign
     * @OA\Put (
     *     path="/api/product-campaign/update/{id}",
     *     tags={"Products Campaign"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="product_id",
     *                         type="integer",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="campaign_id",
     *                         type="integer",
     *                         example=1
     *                     ),
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="Product Campaign was updated successfully."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Product Campaign not found."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Exception",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Error trying to update data."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     * )
     */

    public function update($id, UpdateProductCampaignRequest $request): JsonResponse
    {
        return $this->productCampaignService->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */

    /**
     * Delete Product Campaign
     * @OA\Delete (
     *     path="/api/product-campaign/delete/{id}",
     *     tags={"Products Campaign"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\Property(property="msg", type="string", example="true")
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Product Campaign not found."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      )
     * )
     */

    public function destroy($id): JsonResponse
    {
        return $this->productCampaignService->destroy($id);
    }
}
