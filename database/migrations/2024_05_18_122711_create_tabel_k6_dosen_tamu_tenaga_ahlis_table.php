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
        Schema::create('tabel_k6_dosen_tamu_tenaga_ahlis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_lembaga');
            $table->string('kepakaran');
            $table->date('waktu_kegiatan');
            $table->string('tautan');
            $table->unsignedBigInteger('mk_id');
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('mk_id')->references('id')->on('tabel_matakuliah')->onDelete('cascade');
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
        Schema::dropIfExists('tabel_k6_dosen_tamu_tenaga_ahlis');
    }
};
