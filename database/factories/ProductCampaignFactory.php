<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Product;
use App\Models\ProductCampaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCampaignFactory extends Factory
{
    protected $model = ProductCampaign::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory()->create()->id,
            'campaign_id' => Campaign::factory()->create()->id
        ];
    }
}
