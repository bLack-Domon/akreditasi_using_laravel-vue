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
        Schema::create('tb_bab', function (Blueprint $table) {
            $table->id('id_bab');
            $table->unsignedBigInteger('id_lembaga_akreditasi');
            $table->string('nama_bab');
            $table->text('deskripsi_bab');
            $table->string('status')->nullable();
            $table->string('create_by')->nullable();
            $table->dateTime('create_date')->nullable();
            $table->string('update_by')->nullable();
            $table->dateTime('update_date')->nullable();
            $table->string('delete_by')->nullable();
            $table->dateTime('delete_date')->nullable();

            $table->foreign('id_lembaga_akreditasi')->references('id_lembaga_akreditasi')->on('tb_lembaga_akreditasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_bab');
    }
};
