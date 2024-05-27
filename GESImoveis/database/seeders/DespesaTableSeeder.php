<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DespesaTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('despesa')->insert([
            [
                'id_imovel' => 1,
                'id_user' => 1,
                'id_tipo_despesa' => 1,
                'data' => '2022-01-01',
                'valor' => 100.00
            ],
            [
                'id_imovel' => 1,
                'id_user' => 1,
                'id_tipo_despesa' => 2,
                'data' => '2022-02-01',
                'valor' => 200.00
            ],
            [
                'id_imovel' => 2,
                'id_user' => 1,
                'id_tipo_despesa' => 1,
                'data' => '2022-01-01',
                'valor' => 150.00
            ],
            [
                'id_imovel' => 2,
                'id_user' => 1,
                'id_tipo_despesa' => 2,
                'data' => '2022-02-01',
                'valor' => 250.00
            ]
        ]);
    }
}
