<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PagamentoTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pagamento')->insert([
            [
                'id_contrato' => 1,
                'data_pag' => '2022-01-01',
                'metodo_pag' => 'bank_transfer',
                'valor' => 1000.00
            ],
            [
                'id_contrato' => 1,
                'data_pag' => '2022-02-01',
                'metodo_pag' => 'bank_transfer',
                'valor' => 1000.00
            ],
            [
                'id_contrato' => 1,
                'data_pag' => '2022-03-01',
                'metodo_pag' => 'bank_transfer',
                'valor' => 1000.00
            ],
            [
                'id_contrato' => 2,
                'data_pag' => '2022-02-01',
                'metodo_pag' => 'credit_card',
                'valor' => 2000.00
            ],
            [
                'id_contrato' => 2,
                'data_pag' => '2022-03-01',
                'metodo_pag' => 'credit_card',
                'valor' => 2000.00
            ],
            [
                'id_contrato' => 2,
                'data_pag' => '2022-04-01',
                'metodo_pag' => 'credit_card',
                'valor' => 2000.00
            ]
        ]);
    }
}
