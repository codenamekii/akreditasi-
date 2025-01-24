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
        // create table data_program_studis
        Schema::create('data_program_studis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fakultas_id')->default(1)->nullable();
            $table->enum('jenis', ['S1','S2','S3'])->nullable();;
            $table->string('nama');
            $table->enum('status_peringkat', ['C','B','A','BAIK','BAIK SEKALI','UNGGUL'])->nullable();
            $table->string('nomor_sk')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->integer('jumlah_mhs_ts')->nullable();
            $table->integer('jumlah_dtps_ts')->nullable();
            $table->double('rerata_ipk')->nullable();
            $table->double('rerata_masa_studi')->nullable();
            $table->foreign('fakultas_id')->references('id')->on('fakultas')->onDelete('cascade');
            $table->timestamps();
        });
        
        // create table users

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('prodi_id')->nullable();;
            $table->enum('role',['fakultas','admin prodi','asesor','root'])->nullable();
            $table->rememberToken();
            $table->timestamps();            
            $table->foreign('prodi_id')->references('id')->on('data_program_studis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('data_program_studis');
        

    }
};
