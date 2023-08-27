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
        Schema::create('tb_dokumen_akreditasi', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->unsignedBigInteger('id_detail_pengajuan');
            $table->string('patch_dokumen')->nullable();
            $table->string('status')->nullable();
            $table->string('create_by')->nullable();
            $table->dateTime('create_date')->nullable();
            $table->string('update_by')->nullable();
            $table->dateTime('update_date')->nullable();
            $table->string('delete_by')->nullable();
            $table->dateTime('delete_date')->nullable();

            $table->foreign('id_detail_pengajuan')->references('id_detail_pengajuan')->on('tb_detail_pengajuan_akreditasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_dokumen_akreditasi');
    }
};
