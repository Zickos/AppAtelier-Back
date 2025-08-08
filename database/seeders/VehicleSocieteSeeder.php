<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleSociete;

class VehicleSocieteSeeder extends Seeder
{
    public function run(): void
    {
        VehicleSociete::factory()->count(20)->create();
    }
}
