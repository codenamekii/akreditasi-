<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel 'dokumen'.
     *
     * @return void
     */
    public function up()
    {
        // Membuat tabel 'dokumen' dengan kolom-kolom yang diperlukan
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id' sebagai primary key
            $table->string('nama_dokumen'); // Membuat kolom 'nama_dokumen' untuk menyimpan nama dokumen
            $table->text('keterangan'); // Membuat kolom 'keterangan' untuk menyimpan deskripsi dokumen
            $table->string('path'); // Menambahkan kolom 'path' untuk menyimpan lokasi penyimpanan file
            $table->unsignedBigInteger('repository_id'); // Membuat kolom 'repository_id' sebagai foreign key
            // Menetapkan 'repository_id' sebagai foreign key yang merujuk ke kolom 'id' pada tabel 'repository'
            $table->foreign('repository_id')->references('id')->on('repository')->onDelete('cascade');
            $table->timestamps(); // Membuat kolom 'created_at' dan 'updated_at' untuk pencatatan waktu
        });
    }

    /**
     * Balikkan migrasi dengan menghapus tabel 'dokumen'.
     *
     * @return void
     */
    public function down()
    {
        // Menghapus tabel 'dokumen' jika migrasi dibalikkan
        Schema::dropIfExists('dokumen');
    }
};
