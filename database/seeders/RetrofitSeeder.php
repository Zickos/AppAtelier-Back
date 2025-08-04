<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Retrofit;
use App\Models\TypeTravail;
use App\Models\Demande;

class RetrofitSeeder extends Seeder
{
    public function run(): void
    {
        Retrofit::factory()
            ->count(10)
            ->create()
            ->each(function ($retrofit) {
                // Associe 1 à 3 types de travaux
                $typeTravails = TypeTravail::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $retrofit->typesTravaux()->attach($typeTravails);

                // Associe 1 à 2 demandes existantes aléatoires
                $randomDemandes = Demande::whereNull('retrofit_id') // Pour éviter d’écraser d'autres relations
                    ->inRandomOrder()
                    ->take(rand(1, 2))
                    ->get();

                foreach ($randomDemandes as $demande) {
                    $demande->retrofit()->associate($retrofit);
                    $demande->save();
                }
            });
    }
}
