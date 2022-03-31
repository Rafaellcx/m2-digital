<?php

namespace App\Services;

use App\Http\Helpers\JsonFormat;
use App\Http\Resources\CampaignResource;
use App\Repositories\Contracts\CampaignRepositoryContract;
use App\Repositories\Contracts\GroupRepositoryContract;
use App\Repositories\Contracts\ProductCampaignRepositoryContract;
use App\Services\Contracts\CampaignServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class CampaignService implements CampaignServiceContract
{
    protected $campaignRepository;
    protected $productCampaignRepository;
    protected $groupRepository;

    /**
     * @param CampaignRepositoryContract $campaignRepository
     * @param ProductCampaignRepositoryContract $productCampaignRepository
     * @param GroupRepositoryContract $groupRepository
     */
    public function __construct(
        CampaignRepositoryContract        $campaignRepository,
        ProductCampaignRepositoryContract $productCampaignRepository,
        GroupRepositoryContract           $groupRepository
    )
    {
        $this->campaignRepository = $campaignRepository;
        $this->productCampaignRepository = $productCampaignRepository;
        $this->groupRepository = $groupRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json(CampaignResource::collection($this->campaignRepository->findAll()));
    }

    public function show(int $id): JsonResponse
    {
        $campaign = $this->campaignRepository->findById($id);

        if (!$campaign) {
            return JsonFormat::error('Campaign not found.', [], 404);
        }

        return response()->json(new CampaignResource($campaign));
    }

    public function store(array $fields): JsonResponse
    {
        try {
            $this->campaignRepository->save($fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Ops, Campaign was not created.', [], 500);
        }
        return JsonFormat::success('Campaign was granted successfully.', [], 201);
    }

    public function update(int $id, array $fields): JsonResponse
    {
        try {
            $campaign = $this->campaignRepository->update($id, $fields);
        } catch (Exception $ex) {
            return JsonFormat::error('Error trying to update data.');
        }

        if (!$campaign) {
            return JsonFormat::error('Campaign not found.');
        }

        return JsonFormat::success('Campaign was updated successfully.');
    }

    public function destroy(int $id): JsonResponse
    {
        /**
         * Verify if exists some campaign making reference in the group table.
         */
        $group = $this->groupRepository->findCampaignId($id);

        if ($group) {
            return JsonFormat::error(
                'The campaign cannot be deleted because it is being referenced in the groups table.', [], 500
            );
        }

        /**
         * Verify if exists some campaign making reference in the products_campaign table.
         */
        $productsCampaign = $this->productCampaignRepository->findCampaign($id);

        if (count($productsCampaign) > 0) {
            return JsonFormat::error(
                'The campaign cannot be deleted because it is being referenced in the products_campaign table.',
                [],
                500
            );
        }

        $campaign = $this->campaignRepository->delete($id);

        if (!$campaign) {
            return JsonFormat::error('Campaign not found.', [], 404);
        }

        return response()->json($campaign);
    }

}
