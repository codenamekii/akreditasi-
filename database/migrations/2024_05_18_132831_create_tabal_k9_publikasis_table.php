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
        Schema::create('tabel_k9_publikasis', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('jumlah_ts_2');
            $table->string('jumlah_ts_1');
            $table->string('jumlah_ts');
            $table->string('jumlah')->nullable();
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
        Schema::dropIfExists('tabal_k9_publikasis');
    }
};
