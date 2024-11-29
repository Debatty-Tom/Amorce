<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class ToDoFactory extends Factory
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
            'description'=> $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'date'=> $this->faker->dateTimeBetween('-1 year','2 year')
        ];
    }

}
