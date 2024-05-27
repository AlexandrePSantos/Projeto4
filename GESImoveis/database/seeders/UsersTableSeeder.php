<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@ipvc.pt',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'estado' => 'ativo',
            ],
            [
                'name' => 'proprietario1',
                'email' => 'proprietario1@ipvc.pt',
                'password' => Hash::make('proprietario1'),
                'role' => 'proprietario',
                'estado' => 'ativo',
            ],
            [
                'name' => 'proprietario2',
                'email' => 'proprietario2@ipvc.pt',
                'password' => Hash::make('proprietario2'),
                'role' => 'proprietario',
                'estado' => 'ativo',
            ],
            [
                'name' => 'admin2',
                'email' => 'admin2@ipvc.pt',
                'password' => Hash::make('admin2'),
                'role' => 'admin',
                'estado' => 'ativo',
            ],
        ]);
    }
}
