<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curso::create([
            'estado_id' => 1,
            'descripcion' => 'PRIMER GRADO'
        ]);

        Curso::create([
            'estado_id' => 1,
            'descripcion' => 'SEGUNDO GRADO'
        ]);

        Curso::create([
            'estado_id' => 1,
            'descripcion' => 'TERCERO GRADO'
        ]);
    }
}
