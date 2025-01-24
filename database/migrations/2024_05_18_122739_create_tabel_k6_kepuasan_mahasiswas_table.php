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
        Schema::create('tabel_k6_kepuasan_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('aspek');
            $table->decimal('kinerja_mengajar',4,2);
            $table->decimal('layanan_administrasi_ps',4,2);
            $table->decimal('sarana_prasarana_ps',4,2);
            $table->string('tindak_lanjut');
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
        Schema::dropIfExists('tabel_k6_kepuasan_mahasiswas');
    }
};
