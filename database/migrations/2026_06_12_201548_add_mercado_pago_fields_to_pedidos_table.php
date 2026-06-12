<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->after('status');
            $table->text('pix_copia_cola')->nullable()->after('forma_pagamento');
            $table->text('pix_qr_code_base64')->nullable()->after('pix_copia_cola');
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn(['transaction_id', 'pix_copia_cola', 'pix_qr_code_base64']);
        });
    }
};