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
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('tabel_k5_dana_pkm');
        Schema::dropIfExists('tabel_matakuliah');
        // // Schema::dropIfExists('tabel_dosen');
        // Schema::dropIfExists('data_program_studis');
    }
};
