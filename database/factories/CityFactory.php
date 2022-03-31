<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city,
            'group_id' => Group::factory()->create()->id
        ];
    }
}
