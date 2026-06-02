<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('marca')->nullable();
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2);
            $table->decimal('desconto', 10, 2)->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->integer('quantidade')->default(0);
            $table->string('status');
            $table->string('imagem_principal')->nullable();
            $table->text('imagens_extras')->nullable();
            $table->string('categoria');
            $table->text('cores')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
