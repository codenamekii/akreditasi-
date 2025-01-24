<?php

namespace Database\Seeders;

use App\Models\TabelK5PenggunaanDana as ModelsTabelK5PenggunaanDana;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TabelK5PenggunaanDana extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::create([
            'jenis_penggunaan'=>'Pengeluaran rutin',
            'jumlah_ts2'=>123000,
            'jumlah_ts1'=>123000,
            'jumlah_ts'=>123000,
            'tautan'=>'#',
            'prodi_id'=>123,
        ]);
    }
}
