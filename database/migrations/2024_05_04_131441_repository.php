<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel 'repository'.
     *
     * @return void
     */
    public function up()
    {
        // Membuat tabel 'repository' dengan kolom-kolom yang diperlukan
        Schema::create('repository', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id' sebagai primary key
            $table->string('nama_repository'); // Membuat kolom 'nama_repository' untuk menyimpan nama repository
            $table->text('kriteria'); // Membuat kolom 'kriteria' untuk menyimpan kriteria repository
            $table->unsignedBigInteger('prodi_id'); // Membuat kolom 'prodi id' untuk menyimpan prodi id pembuatan repository
            $table->timestamps(); // Membuat kolom 'created_at' dan 'updated_at' untuk pencatatan waktu

             $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
        });
    }

    /**
     * Balikkan migrasi dengan menghapus tabel 'repository'.
     *
     * @return void
     */
    public function down()
    {
        // Menghapus tabel 'repository' jika migrasi dibalikkan
        Schema::dropIfExists('repository');
    }
};
