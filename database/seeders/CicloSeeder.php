<?php

namespace Database\Seeders;

use App\Models\Ciclo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciclo::create([
            'estado_id' => 1,
            'anio' => 2025
        ]);
    }
}
