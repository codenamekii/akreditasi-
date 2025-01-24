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
        Schema::create('tabel_k7_pelibatan_mhs_penelitians', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_akademik');
            $table->string('judul');
            $table->string('dosen_ketua_id');
            $table->string('kepakaran_ketua');
            $table->string('dosen_anggota')->nullable();
            $table->string('mahasiswa');
            $table->string('tautan');
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('dosen_ketua_id')->references('nidn_nidk')->on('tabel_dosen')->onDelete('cascade');
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
        Schema::dropIfExists('tabel_k7_pelibatan_mhs_penelitians');
    }
};
