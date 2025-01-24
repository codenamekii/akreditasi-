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
        Schema::create('tabel_k5_pemerolehan_danas', function (Blueprint $table) {
            $table->id();
            $table->string('sumber_dana');
            $table->string('jenis_dana');
            $table->double('jumlah_ts2')->default(0);
            $table->double('jumlah_ts1')->default(0);
            $table->double('jumlah_ts')->default(0);
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
        Schema::dropIfExists('tabel_k5_pemerolehan_danas');
    }
};
