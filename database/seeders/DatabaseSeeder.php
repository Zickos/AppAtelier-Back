<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TypeTravailSeeder::class,
            TypeVehicleSeeder::class,
            /* VehicleSeeder::class,
            RetrofitSeeder::class,
            PhotoSeeder::class,
            PlanningSeeder::class,
            DemandeSeeder::class,
            VehicleSocieteSeeder::class, */
        ]);
    }
}
