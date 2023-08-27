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
        Schema::create('tb_pengajuan_lkps', function (Blueprint $table) {
            $table->id('id_pengajuan_lkps');
            $table->unsignedBigInteger('id_lembaga');
            $table->dateTime('tgl_pengajuan');
            $table->dateTime('tgl_penilaian');
            $table->string('patch_dokumen')->nullable();
            $table->string('nilai_lkps')->nullable();
            $table->string('status')->nullable();
            $table->string('create_by')->nullable();
            $table->dateTime('create_date')->nullable();
            $table->string('update_by')->nullable();
            $table->dateTime('update_date')->nullable();
            $table->string('delete_by')->nullable();
            $table->dateTime('delete_date')->nullable();

            $table->foreign('id_lembaga')->references('id_lembaga')->on('tb_lembaga_unuja')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengajuan_lkps');
    }
};
