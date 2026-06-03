<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FuncionarioSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador Geral',
            'email' => 'admin@loja.com',
            'password' => Hash::make('senha123'),
            'cargo' => 'admin',
            'ativo' => true,
        ]);

        User::create([
            'name' => 'Gerente de Vendas',
            'email' => 'gerente@loja.com',
            'password' => Hash::make('senha123'),
            'cargo' => 'gerente',
            'ativo' => true,
        ]);

        User::factory(8)->create([
            'cargo' => 'operador',
            'ativo' => true,
        ]);
    }
}