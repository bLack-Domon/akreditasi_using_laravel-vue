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
        Schema::create('tb_detail_pengajuan_akreditasi', function (Blueprint $table) {
            $table->id('id_detail_pengajuan');
            $table->unsignedBigInteger('id_pengajuan');
            $table->unsignedBigInteger('id_sub_kriteria');
            $table->unsignedBigInteger('id_sub_bab');
            $table->longText('deskripsi_isian')->nullable();
            $table->dateTime('tgl_pengisian')->nullable();
            $table->string('status')->nullable();
            $table->string('create_by')->nullable();
            $table->dateTime('create_date')->nullable();
            $table->string('update_by')->nullable();
            $table->dateTime('update_date')->nullable();
            $table->string('delete_by')->nullable();
            $table->dateTime('delete_date')->nullable();

            $table->foreign('id_pengajuan')->references('id_pengajuan')->on('tb_pengajuan_akreditasi')->onDelete('cascade');
            $table->foreign('id_sub_kriteria')->references('id_sub_kriteria')->on('tb_sub_kriteria')->onDelete('cascade');
            $table->foreign('id_sub_bab')->references('id_sub_bab')->on('tb_sub_bab')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detail_pengajuan_akreditasi');
    }
};
