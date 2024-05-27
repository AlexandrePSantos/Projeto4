<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TipoDespesaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_despesa')->insert([
            ['tipo' => 'Manutenção'],
            ['tipo' => 'Impostos'],
            ['tipo' => 'Seguros'],
            ['tipo' => 'Outros']
        ]);
    }
}
