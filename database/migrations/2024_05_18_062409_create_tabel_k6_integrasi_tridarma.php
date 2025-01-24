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
        Schema::create('tabel_k6_integrasi_tridarma', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->unsignedBigInteger('mk_id');
            $table->string('nidn_nidk');
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('mk_id')->references('id')->on('tabel_matakuliah')->onDelete('cascade');
            $table->foreign('nidn_nidk')->references('nidn_nidk')->on('tabel_dosen')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->text('bentuk_integrasi');
            $table->string('tautan');
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
        Schema::dropIfExists('tabel_k6_integrasi_tridarma');
    }
};
