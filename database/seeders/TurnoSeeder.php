<?php

namespace Database\Seeders;

use App\Models\Turno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Turno::created([
            'estado_id' => 1,
            'descripcion' => 'MAÑANA'
        ]);

        Turno::created([
            'estado_id' => 1,
            'descripcion' => 'TARDE'
        ]);
    }
}
