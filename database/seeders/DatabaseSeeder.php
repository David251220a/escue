<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);

        User::create([
            'documento' => 4918642,
            'name' => 'David',
            'lastname' => 'Ortiz',
            'email' => 'admin@dev',
            'password' => Hash::make('admin123456'),
        ])->assignRole('admin');

        $this->call([
            EstadoSeeder::class,
            CicloSeeder::class,
            TurnoSeeder::class,
            CursoSeeder::class,
        ]);
    }
}
