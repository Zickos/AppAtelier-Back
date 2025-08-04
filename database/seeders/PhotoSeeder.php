<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Photo;
use App\Models\Retrofit;

class PhotoSeeder extends Seeder
{
    public function run(): void
    {
        Retrofit::all()->each(function ($retrofit) {
            Photo::factory()->count(2)->create([
                'retrofit_id' => $retrofit->id,
            ]);
        });
    }
}
