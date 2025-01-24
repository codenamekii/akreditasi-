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
        Schema::create('tabel_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nidn_nidk')->unique();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('sertifikat_pendidik');
            $table->string('jabatan_fungsional');
            $table->string('gelar_akademik');
            $table->string('pendidikan');
            $table->string('bidang_keahlian');
            $table->string('tautan')->nullable();
            $table->enum('sesuai_ps', ['ya', 'tidak'])->nullable();
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
        Schema::dropIfExists('tabel_dosen');
    }
};
