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
        // Schema::create('tabel_dosen', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('nidn_nidk')->unique();
        //     $table->string('nama');
        //     $table->date('tanggal_lahir');
        //     $table->string('sertifikat_pendidik');
        //     $table->string('jabatan_fungsional');
        //     $table->string('gelar_akademik');
        //     $table->string('pendidikan');
        //     $table->string('bidang_keahlian');
        //     $table->enum('sesuai_ps', ['ya', 'tidak'])->nullable();
        //     $table->timestamps();
        // });
        
        Schema::create('tabel_k5_dana_pkm', function(Blueprint $table) {
            $table->id();
            $table->string('judul_pkm');
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

        Schema::create('tabel_k5_sarana_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_sarana');
            $table->integer('jumlah_unit');
            $table->enum('kualitas', ['Baik', 'Kurang Baik', 'Tidak Baik']);
            $table->enum('kondisi', ['terawat','tidak terawat']);
            $table->enum('unit_pengelola', ['PS','UPPS','PT']);
            $table->string('tautan')->default('#');
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('tabel_k5_prasarana_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_prasarana');
            $table->integer('jumlah_unit')->default(0);
            $table->integer('luas')->default(0);
            $table->enum('kepemilikan', ['SD', 'SW']);
            $table->enum('kondisi', ['terawat', 'tidak terawat']);
            $table->integer('penggunaan')->default(0);
            $table->string('tautan')->default('#');
            $table->unsignedBigInteger('prodi_id')->default(1);
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
        Schema::dropIfExists('tabel_c5_s');
        Schema::dropIfExists('tabel_k5_dana_pkm');
        Schema::dropIfExists('tabel_k5_sarana_pendidikan');
        Schema::dropIfExists('tabel_k5_prasarana_pendidikan');
    }
};
