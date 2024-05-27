<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            TipoDespesaTableSeeder::class,
            TipoImovelTableSeeder::class,
            TipoContratoTableSeeder::class,
            InquilinoTableSeeder::class,
            ImovelTableSeeder::class,
            ContratoTableSeeder::class,
            DespesaTableSeeder::class,
            PagamentoTableSeeder::class,
        ]);
    }
}
