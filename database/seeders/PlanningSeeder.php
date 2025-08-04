<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Planning;
use App\Models\Retrofit;
use App\Models\User;

class PlanningSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 6 plannings
        Planning::factory()
            ->count(6)
            ->make()
            ->each(function ($planning) {
                $retrofit = Retrofit::inRandomOrder()->first();
                $planning->retrofit()->associate($retrofit); // assignation correcte
                $planning->vehicle()->associate($retrofit->vehicle); // si besoin
                $planning->save();

                $users = User::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $planning->users()->attach($users);
            });
    }
}
