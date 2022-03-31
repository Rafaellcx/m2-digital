<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'campaign_id' => $this->campaign_id,
            'campaign_name' => $this->campaign_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

    }
}
