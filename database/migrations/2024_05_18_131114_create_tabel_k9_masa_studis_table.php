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
        Schema::create('tabel_k9_masa_studis', function (Blueprint $table) {
            $table->id();
            $table->enum('tahun_masuk',['ts_6','ts_5','ts_4','ts_3','ts_2','ts_1','ts']);
            $table->integer('jumlah_diterima');
            $table->integer('jumlah_lulus_ts_6');
            $table->integer('jumlah_lulus_ts_5');
            $table->integer('jumlah_lulus_ts_4');
            $table->integer('jumlah_lulus_ts_3');
            $table->integer('jumlah_lulus_ts_2');
            $table->integer('jumlah_lulus_ts_1');
            $table->integer('jumlah_lulus_ts'); 
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
        Schema::dropIfExists('tabel_k9_masa_studis');
    }
};
