<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class InquilinoTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('inquilino')->insert([
            [
                'id_user' => 2,
                'nome' => 'John',
                'apelido' => 'Doe',
                'email' => 'john@example.com',
                'telemovel' => '123456789',
                'telefone' => '987654321',
                'morada' => '123 Street',
                'codigo_postal' => '12345',
                'nif' => '123456789'
            ],
            [
                'id_user' => 3,
                'nome' => 'Jane',
                'apelido' => 'Doe',
                'email' => 'jane@example.com',
                'telemovel' => '234567890',
                'telefone' => '098765432',
                'morada' => '456 Avenue',
                'codigo_postal' => '54321',
                'nif' => '987654321'
            ]
        ]);
    }
}
