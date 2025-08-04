<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Retrofit>
 */
class RetrofitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => rand(1, Vehicle::count()),
            'etat' => fake()->boolean(),
            'commentaire' => fake()->paragraph,
            'numero' => strtoupper(fake()->bothify('??###??##')),
            'date' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
