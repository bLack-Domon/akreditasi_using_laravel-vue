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
        Schema::create('tb_sub_bab', function (Blueprint $table) {
            $table->id('id_sub_bab');
            $table->unsignedBigInteger('id_bab');
            $table->string('nama_sub_bab')->nullable();
            $table->text('deskripsi_sub_bab')->nullable();
            $table->string('status')->nullable();
            $table->string('create_by')->nullable();
            $table->dateTime('create_date')->nullable();
            $table->string('update_by')->nullable();
            $table->dateTime('update_date')->nullable();
            $table->string('delete_by')->nullable();
            $table->dateTime('delete_date')->nullable();

            $table->foreign('id_bab')->references('id_bab')->on('tb_bab')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_sub_bab');
    }
};
