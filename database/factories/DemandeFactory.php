<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Demande>
 */
class DemandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'commentaire' => fake()->sentence,
            'user_id' => rand(1, User::count()),
            'etat' => fake()->boolean(),
            'date' => fake()->dateTimeBetween('-1 month', 'now'),
            'type' => fake()->randomElement(['Retrait', 'Commande']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
