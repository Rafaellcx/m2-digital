<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Services\Contracts\DiscountServiceContract;
use Illuminate\Http\JsonResponse;

class DiscountController extends Controller
{
    public $discountService;

    public function __construct(DiscountServiceContract $discountService)
    {
        $this->discountService = $discountService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */

    /**
     * List Discounts
     * @OA\Get (
     *     path="/api/discount/all",
     *     tags={"Discount"},
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
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="45 %"
     *                     ),
     *                     @OA\Property(
     *                         property="value",
     *                         type="decimal",
     *                         example=45
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
        return $this->discountService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDiscountRequest $request
     * @return JsonResponse
     */

    /**
     * Create Discount
     * @OA\Post (
     *     path="/api/discount/store",
     *     tags={"Discount"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="45 %"
     *                     ),
     *                     @OA\Property(
     *                         property="value",
     *                         type="decimal",
     *                         example=45
     *                     ),
     *                 ),
     *                 example={
     *                     "name":"45 %",
     *                     "value":45,
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="type", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="Discount was granted successfully."),
     *              @OA\Property(property="details", type="string", example="[]"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Exception",
     *          @OA\JsonContent(
     *              @OA\Property(property="type", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Ops, discount was not created."),
     *              @OA\Property(property="details", type="string", example="[]"),
     *          )
     *      )
     * )
     */

    public function store(StoreDiscountRequest $request): JsonResponse
    {
        return $this->discountService->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */

    /**
     * Get Discount Details
     * @OA\Get (
     *     path="/api/discount/find/{id}",
     *     tags={"Discount"},
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
     *              @OA\Property(property="name", type="string", example="45 %"),
     *              @OA\Property(property="value", type="decimal", example=45),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="failed"),
     *              @OA\Property(property="message", type="string", example="Discount not found."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     * )
     */

    public function show($id): JsonResponse
    {
        return $this->discountService->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param UpdateDiscountRequest $request
     * @return JsonResponse
     */

    /**
     * Update Discount
     * @OA\Put (
     *     path="/api/discount/update/{id}",
     *     tags={"Discount"},
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
     *                         property="name",
     *                         type="string",
     *                         example="45 %"
     *                     ),
     *                     @OA\Property(
     *                         property="value",
     *                         type="decimal",
     *                         example=45
     *                     ),
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="Discount was updated successfully."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Discount not found."),
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

    public function update($id, UpdateDiscountRequest $request): JsonResponse
    {
        return $this->discountService->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */

    /**
     * Delete Discount
     * @OA\Delete (
     *     path="/api/discount/delete/{id}",
     *     tags={"Discount"},
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
     *              @OA\Property(property="message", type="string", example="Discount not found."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     *     @OA\Response(
     *          response=500,
     *          description="Exception",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="The discount cannot be deleted because it is being referenced in the products table."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     * )
     */

    public function destroy(int $id): JsonResponse
    {
        return $this->discountService->destroy($id);
    }
}
