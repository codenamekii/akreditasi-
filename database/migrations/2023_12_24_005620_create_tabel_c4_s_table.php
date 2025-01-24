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
        Schema::create('tabel_k4_dtps_keahlian_ps', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nidn_nidk');
            $table->date('tanggal_lahir');
            $table->string('sertifikat_pendidik');
            $table->string('jabatan_fungsional');
            $table->string('gelar_akademik');
            $table->string('pendidikan');
            $table->string('bidang_keahlian');
            $table->string('tautan')->default('#');
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade')->default(1);
            $table->timestamps();
        });
        Schema::create('tabel_k4_dtps_luar_ps', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nidn_nidk');
            $table->date('tanggal_lahir');
            $table->string('sertifikat_pendidik');
            $table->string('jabatan_fungsional');
            $table->string('gelar_akademik');
            $table->string('pendidikan');
            $table->string('bidang_keahlian');
            $table->string('tautan')->default('#');
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('tabel_k4_beban_kerja_dtps', function (Blueprint $table) {
            $table->id();
            $table->string('nidn_nidk');
            $table->integer('sks_ps_sendiri');
            $table->integer('sks_ps_luar');
            $table->integer('sks_pt_luar');
            $table->integer('sks_penelitian');
            $table->integer('sks_p2m');
            $table->integer('sks_manajemen_sendiri');
            $table->integer('sks_manajemen_luar');
            $table->string('tautan')->default('#');
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();

            // $table->foreign('nidn_nidk')->references('nidn_nidk')->on('tabel_dosen')->onDelete('cascade');
        });
        Schema::create('tabel_k4_kegiatan_mengajar', function (Blueprint $table) {
            $table->id();
            $table->string('nidn_nidk');
            $table->integer('jumlah_kelas');
            $table->string('kode_mk');
            $table->integer('jum_pertemuan_rencana');
            $table->integer('jum_pertemuan_terlaksana');
            $table->enum('semester', ['Gasal', 'Genap'])->nullable();
            $table->string('tautan')->default('#');
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();

            // $table->foreign('nidn_nidk')->references('nidn_nidk')->on('tabel_dosen')->onDelete('cascade');
        });

        Schema::create('tabel_k4_bimbingan_ta', function(Blueprint $table){
            $table->id();
            $table->string('nidn_nidk');
            $table->integer('ts_2');
            $table->integer('ts_1');
            $table->integer('ts');
            $table->string('tautan');
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('tabel_k4_prestasi_dtps', function(Blueprint $table){
            $table->id();
            $table->string('nidn_nidk');
            $table->string('prestasi');
            $table->string('tahun');
            $table->enum('tingkat',['Internasional', 'Nasional', 'Lokal'])->default('Lokal');
            $table->string('tautan');
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tabel_k4_pengembangan_kompetensi_dtps', function(Blueprint $table){
            $table->id();
            $table->string('nidn_nidk');
            $table->string('bidang_keahlian');
            $table->string('nama_kegiatan');
            $table->string('tempat');
            $table->date('waktu');
            $table->string('manfaat');
            $table->string('tautan');
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tabel_tendik', function(Blueprint $table){
            $table->id();
            $table->string('id_tendik')->unique();
            $table->string('nama');
            $table->string('status');
            $table->string('bidang_keahlian');
            $table->enum('pendidikan', ['SLTA','Diploma','S1','S2','S3']);
            $table->enum('unit_kerja', ['PS','UPPS','PT']);
            $table->string('tautan');
            $table->unsignedBigInteger('prodi_id')->default(1);
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tabel_k4_kompetensi_tendik', function(Blueprint $table){
            $table->id();
            $table->string('id_tendik');
            $table->string('nama_kegiatan');
            // $table->string('tahun');
            // $table->string('lama_kegiatan');
            $table->date('waktu_mulai');
            $table->date('waktu_selesai');
            $table->string('tempat');
            $table->string('tautan');
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
        Schema::dropIfExists('tabel_c4_s');
        Schema::dropIfExists('tabel_k4_dtps_keahlian_ps');
        Schema::dropIfExists('tabel_k4_dtps_luar_ps');
        Schema::dropIfExists('tabel_k4_beban_kerja_dtps');
        Schema::dropIfExists('tabel_k4_kegiatan_mengajar');
        Schema::dropIfExists('tabel_k4_bimbingan_ta');
        Schema::dropIfExists('tabel_k4_prestasi_dtps');
        Schema::dropIfExists('tabel_k4_pengembangan_kompetensi_dtps');
        Schema::dropIfExists('tabel_tendik');
        Schema::dropIfExists('tabel_k4_kompetensi_tendik');
    }
};
