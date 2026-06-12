<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cartaos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('apelido_cartao')->nullable();
            $table->string('tipo_cartao');
            $table->string('nome_impresso');
            $table->string('numero_cartao');
            $table->string('validade');
            $table->string('codigo_seguranca')->nullable();
            $table->string('bandeira')->nullable();
            $table->boolean('principal')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cartaos');
    }
};