<?php

namespace App\Services;

use App\Http\Helpers\JsonFormat;
use App\Http\Resources\CityResource;
use App\Repositories\Contracts\CityRepositoryContract;
use App\Services\Contracts\CityServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class CityService implements CityServiceContract
{
    protected $cityRepository;

    /**
     * @param CityRepositoryContract $cityRepository
     */
    public function __construct(CityRepositoryContract $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json(CityResource::collection($this->cityRepository->findAll()));
    }

    public function show(int $id): JsonResponse
    {
        $city = $this->cityRepository->findById($id);

        if (!$city) {
            return JsonFormat::error('City not found.');
        }

        return response()->json(new CityResource($city));
    }

    public function store(array $fields): JsonResponse
    {
        try {
            $this->cityRepository->save($fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Ops, City was not created.');
        }

        return JsonFormat::success('City was granted successfully.', [], 201);
    }

    public function update(int $id, array $fields): JsonResponse
    {
        try {
            $city = $this->cityRepository->update($id, $fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Error trying to update data.');
        }

        if (!$city) {
            return JsonFormat::error('City not found.');
        }

        return JsonFormat::success('City was updated successfully.');
    }

    public function destroy(int $id): JsonResponse
    {
        $city = $this->cityRepository->delete($id);

        if (!$city) {
            return JsonFormat::error('City not found.');
        }

        return response()->json($city);
    }

}
