<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Retrofit;
use App\Models\Vehicle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planning>
 */
class PlanningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('+1 day', '+14 days');
        $end = (clone $start)->modify('+14 days');

        return [
            'date_debut' => $start,
            'date_fin' => $end,
            'vehicle_id' => rand(1, Vehicle::count()),
            'retrofit_id' => rand(1, Retrofit::count()),
            'etat' => fake()->boolean(),
            'commentaire' => fake()->sentence,
        ];
    }
}
