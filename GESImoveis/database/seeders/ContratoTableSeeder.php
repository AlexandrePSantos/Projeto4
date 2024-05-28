<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ContratoTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('contrato')->insert([
            [
                'id_inquilino' => 1,
                'id_imovel' => 1,
                'id_tipo_contrato' => 1,
                'id_user' => 2,
                'data_ini' => '2022-01-01',
                'data_fim' => '2023-01-01',
                'valor' => 1000.00,
                'perocidade_pag' => 'monthly',
                'estado' => 'active',
                'data_termino' => null,
                'valor_pago' => 0.00
            ],
            [
                'id_inquilino' => 2,
                'id_imovel' => 2,
                'id_tipo_contrato' => 2,
                'id_user' => 3,
                'data_ini' => '2022-02-01',
                'data_fim' => '2023-02-01',
                'valor' => 2000.00,
                'perocidade_pag' => 'monthly',
                'estado' => 'active',
                'data_termino' => null,
                'valor_pago' => 0.00
            ]
        ]);
    }
}
