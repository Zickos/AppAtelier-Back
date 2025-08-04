<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TypeVehicle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'marque' => fake()->randomElement(['Avia', 'Air France', 'Interappro']),
            'owner' => fake()->name,
            'num_serie' => strtoupper(fake()->bothify('??###??##')),
            'id_client' => fake()->uuid,
            'type_vehicle_id' => rand(1, TypeVehicle::count()),
        ];
    }
}
