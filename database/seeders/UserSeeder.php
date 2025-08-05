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
        User::factory()->create([
            'prenom' => 'Admin',
            'email' => 'admin@interappro.fr',
            'password' => Hash::make('Adm1terappro'),
            'role_id' => '1',
        ]);

        User::factory()->create([
            'prenom' => 'Arnaud',
            'email' => 'arnaud@interappro.fr',
            'password' => Hash::make('Arn1terappro'),
            'role_id' => '2',
        ]);

        User::factory()->create([
            'prenom' => 'Ludovic',
            'email' => 'ludovic@interappro.fr',
            'password' => Hash::make('Lud1terappro'),
            'role_id' => '2',
        ]);

        User::factory()->create([
            'prenom' => 'Evan',
            'email' => 'evan@interappro.fr',
            'password' => Hash::make('Eva1terappro'),
            'role_id' => '2',
        ]);

        User::factory()->create([
            'prenom' => 'Guillaume',
            'email' => 'guillaume@interappro.fr',
            'password' => Hash::make('Gui1terappro'),
            'role_id' => '2',
        ]);

        User::factory()->create([
            'prenom' => 'Maxence',
            'email' => 'maxence@interappro.fr',
            'password' => Hash::make('Max1terappro'),
            'role_id' => '4',
        ]);

        User::factory()->create([
            'prenom' => 'Arthur',
            'email' => 'arthur@interappro.fr',
            'password' => Hash::make('Art1terappro'),
            'role_id' => '4',
        ]);

        User::factory()->create([
            'prenom' => 'Louis',
            'email' => 'louis@interappro.fr',
            'password' => Hash::make('Lou1terappro'),
            'role_id' => '4',
        ]);

        User::factory()->create([
            'prenom' => 'Tiago',
            'email' => 'tiago@interappro.fr',
            'password' => Hash::make('Tia1terappro'),
            'role_id' => '4',
        ]);

        User::factory()->create([
            'prenom' => 'Alison',
            'email' => 'alison@interappro.fr',
            'password' => Hash::make('Ali1terappro'),
            'role_id' => '3',
        ]);

        User::factory()->create([
            'prenom' => 'Thomas',
            'email' => 'thomas@interappro.fr',
            'password' => Hash::make('Tho1terappro'),
            'role_id' => '3',
        ]);
    }
}
