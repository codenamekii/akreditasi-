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
        Schema::create('data_keuangans', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->integer('pendidikan_per_mahasiswa');
            $table->integer('penelitian_per_dosen');
            $table->integer('pkm_per_dosen');
            $table->integer('publikasi_per_dosen');
            $table->decimal('investasi',12,2);
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
        Schema::dropIfExists('data_keuangans');
    }
};
