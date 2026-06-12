<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'data_nascimento')) {
            Schema::table('users', function (Blueprint $table) {
                $table->date('data_nascimento')->nullable()->after('email');
            });
        }

        if (!Schema::hasColumn('users', 'sexo')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('sexo')->nullable()->after('data_nascimento');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'sexo')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('sexo');
            });
        }

        if (Schema::hasColumn('users', 'data_nascimento')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('data_nascimento');
            });
        }
    }
};