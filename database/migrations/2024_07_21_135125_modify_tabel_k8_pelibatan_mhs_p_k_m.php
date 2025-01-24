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
        Schema::table('tabel_k8_pelibatan_mhs_pkms', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['dosen_anggota_id']);

            // Rename the column and change its type to VARCHAR(255) allowing NULL
            $table->renameColumn('dosen_anggota_id', 'dosen_anggota');

            // Change the column type to VARCHAR(255) and allow NULL
            // $table->string('dosen_anggota', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('tabel_k8_pelibatan_mhs_pkms');
    }
};
