<?php

namespace App\Services;

use App\Http\Helpers\JsonFormat;
use App\Http\Resources\GroupResource;
use App\Repositories\Contracts\CityRepositoryContract;
use App\Repositories\Contracts\GroupRepositoryContract;
use App\Services\Contracts\GroupServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class GroupService implements GroupServiceContract
{
    protected $groupRepository;
    protected $cityRepository;

    /**
     * @param GroupRepositoryContract $groupRepository
     * @param CityRepositoryContract $cityRepository
     */
    public function __construct(
        GroupRepositoryContract $groupRepository,
        CityRepositoryContract  $cityRepository
    )
    {
        $this->groupRepository = $groupRepository;
        $this->cityRepository = $cityRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json(GroupResource::collection($this->groupRepository->findAll()));
    }

    public function show(int $id): JsonResponse
    {
        $group = $this->groupRepository->findById($id);

        if (!$group) {
            return JsonFormat::error('Group not found.', [], 404);
        }

        return response()->json(new GroupResource($group));
    }

    public function store(array $fields): JsonResponse
    {
        try {
            $this->groupRepository->save($fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Ops, Group was not created.', [], 500);
        }
        return JsonFormat::success('Group was granted successfully.', [], 201);
    }

    public function update(int $id, array $fields): JsonResponse
    {
        try {
            $group = $this->groupRepository->update($id, $fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Error trying to update data.', [], 500);
        }

        if (!$group) {
            return JsonFormat::error('Group not found.', [], 404);
        }

        return JsonFormat::success('Group was updated successfully.');
    }

    public function destroy(int $id): JsonResponse
    {
        /**
         * Verify if exists some group making reference in the cities table.
         */
        $city = $this->cityRepository->findGroup($id);

        if ($city) {
            return JsonFormat::error(
                'The group cannot be deleted because it is being referenced in the cities table.', [], 500
            );
        }

        $group = $this->groupRepository->delete($id);

        if (!$group) {
            return JsonFormat::error('Group not found.', [], 404);
        }

        return response()->json($group);
    }

}
