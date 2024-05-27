<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TipoImovelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_imovel')->insert([
            ['tipo' => 'T0', 'estado' => 'ativo'],
            ['tipo' => 'T1', 'estado' => 'ativo'],
            ['tipo' => 'T2', 'estado' => 'ativo'],
            ['tipo' => 'T3', 'estado' => 'ativo']
        ]);
    }
}
