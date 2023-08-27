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
        Schema::create('tb_pengajuan_akreditasi', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->unsignedBigInteger('id_lembaga_akreditasi');
            $table->unsignedBigInteger('id_lembaga');
            $table->dateTime('tgl_pengajuan');
            $table->string('status')->nullable();
            $table->string('create_by')->nullable();
            $table->dateTime('create_date')->nullable();
            $table->string('update_by')->nullable();
            $table->dateTime('update_date')->nullable();
            $table->string('delete_by')->nullable();
            $table->dateTime('delete_date')->nullable();

            $table->foreign('id_lembaga_akreditasi')->references('id_lembaga_akreditasi')->on('tb_lembaga_akreditasi')->onDelete('cascade');
            $table->foreign('id_lembaga')->references('id_lembaga')->on('tb_lembaga_unuja')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengajuan_akreditasi');
    }
};
