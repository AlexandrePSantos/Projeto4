<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ImovelTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('imovel')->insert([
            [
                'id_tipo_imovel' => 1,
                'id_user' => 1,
                'area' => 100,
                'morada' => '123 Street',
                'andar' => 1,
                'num_divisoes' => 3,
                'ano_construcao' => 2000,
                'val_seguro' => 200.00,
                'val_imi' => 100.00,
                'val_condominio' => 50.00,
                'data_aquisicao' => '2000-01-01',
                'preco_compra' => 100000.00
            ],
            [
                'id_tipo_imovel' => 2,
                'id_user' => 3,
                'area' => 200,
                'morada' => '456 Avenue',
                'andar' => 2,
                'num_divisoes' => 4,
                'ano_construcao' => 2010,
                'val_seguro' => 300.00,
                'val_imi' => 150.00,
                'val_condominio' => 75.00,
                'data_aquisicao' => '2010-01-01',
                'preco_compra' => 200000.00
            ]
        ]);
    }
}
