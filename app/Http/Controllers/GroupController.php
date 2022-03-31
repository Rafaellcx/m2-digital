<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Services\Contracts\GroupServiceContract;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    public $groupService;

    public function __construct(GroupServiceContract $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */

    /**
     * List Groups
     * @OA\Get (
     *     path="/api/group/all",
     *     tags={"Group"},
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
     *                         property="name",
     *                         type="string",
     *                         example="example name"
     *                     ),
     *                     @OA\Property(
     *                         property="campaign_id",
     *                         type="number",
     *                         example=1
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
        return $this->groupService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGroupRequest $request
     * @return JsonResponse
     */

    /**
     * Create Group
     * @OA\Post (
     *     path="/api/group/store",
     *     tags={"Group"},
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
     *                     @OA\Property(
     *                         property="campaign_id",
     *                         type="number",
     *                         example=1
     *                     ),
     *                 ),
     *                 example={
     *                     "name":"example campaign name",
     *                     "campaign_id":1,
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="Group was granted successfully."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Exception",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Ops, group was not created."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      )
     * )
     */

    public function store(StoreGroupRequest $request): JsonResponse
    {
        return $this->groupService->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */

    /**
     * Get Group Details
     * @OA\Get (
     *     path="/api/group/find/{id}",
     *     tags={"Group"},
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
     *              @OA\Property(property="name", type="string", example="example group name"),
     *              @OA\Property(property="campaign_id", type="number", example=2),
     *              @OA\Property(property="campaign_name", type="string", example="example campaign name"),
     *              @OA\Property(property="cities", type="string", example="[...]"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="failed"),
     *              @OA\Property(property="message", type="string", example="Group not found."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     * )
     */

    public function show($id): JsonResponse
    {
        return $this->groupService->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param UpdateGroupRequest $request
     * @return JsonResponse
     */

    /**
     * Update Group
     * @OA\Put (
     *     path="/api/group/update/{id}",
     *     tags={"Group"},
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
     *              @OA\Property(property="message", type="string", example="Group was updated successfully."),
     *              @OA\Property(property="data", type="string", example="[]"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Group not found."),
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

    public function update($id, UpdateGroupRequest $request): JsonResponse
    {
        return $this->groupService->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */

    /**
     * Delete Group
     * @OA\Delete (
     *     path="/api/group/delete/{id}",
     *     tags={"Group"},
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

    public function destroy($id): JsonResponse
    {
        return $this->groupService->destroy($id);
    }
}
