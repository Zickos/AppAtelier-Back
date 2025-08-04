<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeTravail;

class TypeTravailSeeder extends Seeder
{
    public function run(): void
    {
        $travails = ['Électrique', 'Carrosserie', 'Logiciel', 'Diagnostic'];

        foreach ($travails as $travailName) {
            TypeTravail::firstOrCreate(['name' => $travailName]);
        }
    }
}
