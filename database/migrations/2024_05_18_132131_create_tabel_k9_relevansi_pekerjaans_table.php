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
        Schema::create('tabel_k9_relevansi_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun_lulus');
            $table->string('jumlah_lulusan');
            $table->string('jumlah_terlacak');
            $table->integer('relevansi_tinggi');
            $table->integer('relevansi_sedang');
            $table->integer('relevansi_rendah');
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
        Schema::dropIfExists('tabel_k9_relevansi_pekerjaans');
    }
};
