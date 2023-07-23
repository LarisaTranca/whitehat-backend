<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BrandGame>
 */
class BrandGameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'launchcode'       => Str::random(10),
            'brandid'          => 0,
            'new'              => $this->faker->boolean(),
            'hot'              => $this->faker->boolean(),
            'category'         => $this->faker->randomElements('slots', 'classic', 'poker', 'new', 'fun')
        ];
    }
}
