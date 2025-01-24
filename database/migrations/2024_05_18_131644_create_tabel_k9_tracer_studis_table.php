<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabel_k9_tracer_studis', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun_lulus');
            $table->integer('jumlah_lulusan');
            $table->integer('jumlah_terlacak');
            $table->integer('waktu_tunggu_wt3');
            $table->integer('waktu_tunggu_wt36');
            $table->integer('waktu_tunggu_wt612');
            $table->integer('waktu_tunggu_wt12');
            $table->string('tautan')->nullable();
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabel_k9_tracer_studis');
    }
};
