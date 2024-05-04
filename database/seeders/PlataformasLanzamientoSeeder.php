<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlataformasLanzamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plataformasActuales = [
            ['img' => 'xboxseriesxs.png', 'nombre' => 'Xbox Series S|X'],
            ['img' => 'ps5.png', 'nombre' => 'PlayStation 5'],
            ['img' => 'nswitch.png', 'nombre' => 'Nintendo Switch'],
            ['img' => 'androidios.png', 'nombre' => 'Android/iOS'],
            ['img' => 'pcs.png', 'nombre' => 'PC'],
        ];

        DB::table('plataforma_lanzamiento')->insert($plataformasActuales);
    }
}
