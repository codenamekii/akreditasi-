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
        Schema::create('tabel_k9_karya_disitasis', function (Blueprint $table) {
            $table->id();
            $table->string('penulis_dosen_id')->nullable();
            $table->string('penulis_mahasiswa')->nullable();
            $table->string('judul');
            $table->string('tahun',4);
            $table->string('nama_penerbit');
            $table->string('nomor_halaman')->nullable();
            $table->integer('jumlah_sitasi');
            $table->string('tautan')->nullable();
            $table->foreign('penulis_dosen_id')->references('nidn_nidk')->on('tabel_dosen')->onDelete('cascade');
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
        Schema::dropIfExists('tabal_k9_karya_disitasis');
    }
};
