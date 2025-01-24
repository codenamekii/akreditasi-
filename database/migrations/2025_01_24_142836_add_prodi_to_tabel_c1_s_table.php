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
        Schema::table('tabel_c1_s', function (Blueprint $table) {
            $table->string('prodi')->after('visi_misi'); // Tambahkan kolom prodi setelah visi_misi
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tabel_c1_s', function (Blueprint $table) {
            $table->dropColumn('prodi'); // Hapus kolom prodi jika rollback
        });
    }
};
