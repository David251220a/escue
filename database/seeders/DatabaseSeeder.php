<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Persona;
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

        $user = User::create([
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
            PaiSeeder::class,
            PadreTipoSeeder::class,
        ]);

        Persona::create([
            'documento' => 4918642,
            'nombre' => 'DAVID',
            'apellido' => 'ORTIZ',
            'pais_id' => 1,
            'estado_id' => 1,
            'fecha_nacimiento' => '1998-11-11',
            'sexo' => 1,
            'email' => 'admin@dev',
            'celular' => '0976820842',
            'direccion' => 'RUTA 1 KM 19',
            'foto' => null,
        ]);
    }
}
