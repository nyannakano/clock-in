<?php

namespace Database\Factories;

use App\Models\Configuration;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'configuration_id' => Configuration::factory()->create()->id,
        ];
    }
}
