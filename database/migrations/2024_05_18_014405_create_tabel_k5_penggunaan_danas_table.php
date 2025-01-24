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
        Schema::create('tabel_k5_penggunaan_danas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_penggunaan');
            $table->double('jumlah_ts2');
            $table->double('jumlah_ts1');
            $table->double('jumlah_ts');
            $table->string('tautan');
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
        Schema::dropIfExists('tabel_k5_penggunaan_danas');
    }
};
