<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fund>
 */
class FundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> $this->faker->words(3, true),
            'description'=> $this->faker->words(4, true),
            'total'=> $this->faker->numberBetween(0, 500000),
            'type'=> $this->faker->randomElement(['principal', 'specific']),
            ];
    {

    }
    }
}
