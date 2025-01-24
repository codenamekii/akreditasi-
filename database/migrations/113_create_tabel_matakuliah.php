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
        Schema::create('tabel_matakuliah', function(Blueprint $table){
            $table->id();
            $table->string('kode_mk')->uniqid();
            $table->string('nama');
            $table->integer('sks');
            $table->integer('semester');
            $table->enum('jenis_matakuliah', ['teori','praktikum','praktik']);
            $table->enum('unit_penyelenggara', ['pt','upps','ps']);
            $table->enum('kesesuaian_cpl', ['ya', 'tidak']);
            $table->string('perangkat_pembelajaran')->nullable();;

            $table->string('tautan')->default('#');
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
        Schema::dropIfExists('tabel_matakuliah');
    }
};
