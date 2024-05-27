<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TipoContratoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_contrato')->insert([
            [
                'tipo' => 'Arrendamento de longa duração',
            ],
            [
                'tipo' => 'Arrendamento de curta duração',
            ],
        ]);
    }
}
