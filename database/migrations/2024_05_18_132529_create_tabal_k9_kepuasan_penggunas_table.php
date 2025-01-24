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
        Schema::create('tabel_k9_kepuasan_penggunas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kemampuan');
            $table->decimal('sangat_baik');
            $table->decimal('baik');
            $table->decimal('cukup');
            $table->decimal('kurang');
            $table->string('tindak_lanjut');
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
        Schema::dropIfExists('tabel_k9_kepuasan_penggunas');
    }
};
