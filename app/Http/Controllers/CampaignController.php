<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Services\Contracts\CampaignServiceContract;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
    public $campaignService;

    public function __construct(CampaignServiceContract $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */

    /**
     * List Campaigns
     * @OA\Get (
     *     path="/api/campaign/all",
     *     tags={"Campaign"},
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
     *                         example="example name"
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
        return $this->campaignService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCampaignRequest $request
     * @return JsonResponse
     */

    /**
     * Create Campaign
     * @OA\Post (
     *     path="/api/campaign/store",
     *     tags={"Campaign"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="example name"
     *                     ),
     *                 ),
     *                 example={
     *                     "name":"example campaign name",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="name", type="string", example="Campaign was granted successfully."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Exception",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Ops, Campaign was not created."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      )
     * )
     */

    public function store(StoreCampaignRequest $request): JsonResponse
    {
        return $this->campaignService->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */

    /**
     * Get Campaign Details
     * @OA\Get (
     *     path="/api/campaign/find/{id}",
     *     tags={"Campaign"},
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
     *              @OA\Property(property="name", type="string", example="example campaign name"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Campaign not found."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     * )
     */

    public function show($id): JsonResponse
    {
        return $this->campaignService->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param UpdateCampaignRequest $request
     * @return JsonResponse
     */

    /**
     * Update Campaign
     * @OA\Put (
     *     path="/api/campaign/update/{id}",
     *     tags={"Campaign"},
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
     *                         example="Example campaign name"
     *                     )
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="Campaign was updated successfully."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Campaign not found."),
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

    public function update($id, UpdateCampaignRequest $request): JsonResponse
    {
        return $this->campaignService->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */

    /**
     * Delete Campaign
     * @OA\Delete (
     *     path="/api/campaign/delete/{id}",
     *     tags={"Campaign"},
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
     *              @OA\Property(property="message", type="string", example="Campaign not found."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     *     @OA\Response(
     *          response=500,
     *          description="Exception",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="The campaign cannot be deleted because it is being referenced in the products_campaign table."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     * )
     */

    public function destroy($id): JsonResponse
    {
        return $this->campaignService->destroy($id);
    }
}
