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
        Schema::create('tabel_k6_kegiatan_akademiks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('nidn_nidk');
            $table->string('frekuensi');
            $table->string('hasil');
            $table->string('tautan');
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('nidn_nidk')->references('nidn_nidk')->on('tabel_dosen')->onDelete('cascade');
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
        Schema::dropIfExists('tabel_k6_kegiatan_akademiks');
    }
};
