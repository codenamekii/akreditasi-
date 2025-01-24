<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TabelK9RelevansiPekerjaan;

class TabelK9RelevansiPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TabelK9RelevansiPekerjaan::create([
            'tahun_lulus' => date('Y'),
            'jumlah_lulusan' => '100',
            'jumlah_terlacak' => '50',
            'relevansi_tinggi' => 30,
            'relevansi_sedang' => 20,
            'relevansi_rendah' => 10,
            'tautan' => 'https://www.google.com',
            'prodi_id' => 123,
        ]);

        TabelK9RelevansiPekerjaan::create([
            'tahun_lulus' => date('Y') - 1,
            'jumlah_lulusan' => 100,
            'jumlah_terlacak' => 50,
            'relevansi_tinggi' => 60,
            'relevansi_sedang' => 40,
            'relevansi_rendah' => 30,
            'tautan' => 'https://www.google.com',
            'prodi_id' => 123,
        ]);
    }
}
