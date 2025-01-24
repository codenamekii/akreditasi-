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
        Schema::create('tabel_k5_dana_penelitians', function (Blueprint $table) {
            $table->id();
            $table->string('judul_penelitian');
            $table->string('nidn_nidk');
            $table->string('sumber_dana');
            $table->double('jumlah_dana_ts2');
            $table->double('jumlah_dana_ts1');
            $table->double('jumlah_dana_ts');
            $table->string('tautan')->nullable();
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->foreign('nidn_nidk')->references('nidn_nidk')->on('tabel_dosen')->onDelete('cascade');
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
        Schema::dropIfExists('tabel_k5_dana_penelitians');
    }
};
