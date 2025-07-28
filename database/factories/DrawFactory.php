<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Draw>
 */
class DrawFactory extends Factory
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
            'amount'=> $this->faker->numberBetween(0, 100000),
            'date'=> $this->faker->dateTimeBetween('-2 year','-1 day')
        ];
    }
}
