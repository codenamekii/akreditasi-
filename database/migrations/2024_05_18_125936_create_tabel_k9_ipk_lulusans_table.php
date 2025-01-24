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
        Schema::create('tabel_k9_ipk_lulusans', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('jumlah_lulusan');
            $table->decimal('minimum', 4, 2);
            $table->decimal('rata_rata', 4, 2);
            $table->decimal('maksimum', 4, 2);
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
        Schema::dropIfExists('tabel_k9_ipk_lulusans');
    }
};
