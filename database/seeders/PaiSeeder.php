<?php

namespace Database\Seeders;

use App\Models\Pai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pai::create([
            'estado_id' => 1,
            'descripcion' => 'PARAGUAY',
        ]);
    }
}
