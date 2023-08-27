<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_lembaga_unuja', function (Blueprint $table) {
            $table->id('id_lembaga');
            $table->string('nama_lembaga')->nullable();
            $table->string('user')->unique()->nullable();
            $table->string('password');
            $table->string('status_akun')->nullable();
            $table->string('status_aktif')->nullable();
            $table->string('create_by')->nullable();
            $table->dateTime('create_date')->nullable();
            $table->string('update_by')->nullable();
            $table->dateTime('update_date')->nullable();
            $table->string('delete_by')->nullable();
            $table->dateTime('delete_date')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
