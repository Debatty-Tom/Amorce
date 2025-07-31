<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description'=> $this->faker->words(4, true),
            'amount'=> $this->faker->numberBetween(-5000, 10000),
            'date'=> $this->faker->dateTimeBetween('-2 year','-10 day'),
            'hash'=> $this->faker->md5(),
        ];
    }
}
