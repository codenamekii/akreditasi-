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
        Schema::create('tabel_k6_bimbingan_tas', function (Blueprint $table) {
            $table->id();
            $table->string('nidn_nidk');
            $table->integer('jumlah_ps_sendiri_ts2')->default(0);
            $table->integer('jumlah_ps_sendiri_ts1')->default(0);
            $table->integer('jumlah_ps_sendiri_ts')->default(0);
            $table->integer('jumlah_ps_lain_ts2')->default(0);
            $table->integer('jumlah_ps_lain_ts1')->default(0);
            $table->integer('jumlah_ps_lain_ts')->default(0);
            $table->integer('rata_pertemuan')->default(0);
            $table->string('tautan')->default('#');
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
        Schema::dropIfExists('tabel_k6_bimbingan_tas');
    }
};
