<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(5)->create();
        User::factory()->create([
            'prenom' => 'Admin',
            'email' => 'a@a.com',
            'password' => Hash::make('password'),
            'role_id' => '1',
        ]);

        User::factory()->create([
            'prenom' => 'Tech',
            'email' => 't@a.com',
            'password' => Hash::make('password'),
            'role_id' => '2',
        ]);
    }
}
