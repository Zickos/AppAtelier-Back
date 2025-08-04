<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Demande;
use App\Models\User;

class DemandeSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            $retrofits = $user->plannings
                ->load('vehicle.retrofits')
                ->pluck('vehicle.retrofits')
                ->flatten()
                ->unique('id')
                ->values();

            if ($retrofits->isEmpty()) return; // ⚠️ Ne rien faire si aucun retrofit

            Demande::factory()->count(rand(1, 3))->create([
                'user_id' => $user->id,
                'retrofit_id' => $retrofits->random()->id,
            ]);
        });
    }
}
