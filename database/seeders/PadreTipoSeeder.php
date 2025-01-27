<?php

namespace Database\Seeders;

use App\Models\PadreTipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PadreTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PadreTipo::create([
            'estado_id' => 1,
            'descripcion' => 'PADRE'
        ]);

        PadreTipo::create([
            'estado_id' => 1,
            'descripcion' => 'MADRE'
        ]);

        PadreTipo::create([
            'estado_id' => 1,
            'descripcion' => 'ENCARGADO/A'
        ]);
    }
}
