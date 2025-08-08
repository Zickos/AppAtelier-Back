<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleSociete>
 */
class VehicleSocieteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'marque' => $this->faker->company(),
            'model' => $this->faker->word(),
            'immatriculation' => strtoupper($this->faker->bothify('??-###-??')),
            'datemec' => $this->faker->date(),
            'usage' => $this->faker->randomElement(['Interne', 'Externe']),
            'site' => $this->faker->city(),
            'copiecg' => 'copie_cg.pdf',
            'copieassurance' => 'assurance.pdf',
            'affectation' => $this->faker->word(),
            'commentaire' => $this->faker->sentence(),
            'datect' => $this->faker->date(),
            'dateprochainct' => $this->faker->date(),
            'dateentretien' => $this->faker->date(),
            'dateprochainentretien' => $this->faker->date(),
        ];
    }
}
