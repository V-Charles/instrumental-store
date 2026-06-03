<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            FuncionarioSeeder::class,
            ProdutoSeeder::class,
            ClienteSeeder::class,
            PedidoSeeder::class,
            PagamentoSeeder::class,
            DevolucaoSeeder::class,
        ]);
    }
}