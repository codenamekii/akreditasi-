<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabel_k3_mahasiswa_reguler', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_akademik');
            $table->integer('daya_tampung');
            $table->integer('pendaftar');
            $table->integer('lulus_seleksi');
            $table->integer('jum_mahasiswa_baru');
            $table->integer('total');
            $table->string('tautan')->nullable();
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tabel_k3_mhs_dalam_negeri', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_akademik');
            $table->integer('jumlah_provinsi');
            $table->integer('laki_laki');
            $table->integer('perempuan');
            // $table->integer('total_mahasiswa');
            $table->string('tautan')->nullable();
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tabel_k3_mhs_luar_negeri', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_akademik');
            $table->integer('jumlah_negara');
            $table->integer('laki_laki');
            $table->integer('perempuan');
            $table->integer('total_mahasiswa');
            $table->string('tautan')->nullable();
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tabel_k3_layanan_pembinaan_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_akademik');
            $table->integer('minat');
            $table->integer('bakat');
            $table->integer('penalaran');
            $table->integer('kesejahteraan');
            $table->integer('keprofesian');
            $table->string('tautan')->nullable();
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('tabel_k3_mahasiswa_reguler');
        Schema::dropIfExists('tabel_k3_mhs_dalam_negeri');
        Schema::dropIfExists('tabel_k3_mhs_luar_negeri');
        Schema::dropIfExists('tabel_k3_layanan_pembinaan_mahasiswa');
    }
};
