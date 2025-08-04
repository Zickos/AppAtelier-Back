<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeVehicle;

class TypeVehicleSeeder extends Seeder
{
    public function run(): void
    {
        $typevehicles = ['TMX', 'ABS', 'Charlatte', 'Fenwick', 'Autre'];

        foreach ($typevehicles as $typevehicleName) {
            TypeVehicle::firstOrCreate(['name' => $typevehicleName]);
        }
    }
}
