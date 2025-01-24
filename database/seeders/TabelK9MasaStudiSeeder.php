<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TabelK9MasaStudi;

class TabelK9MasaStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masaStudi = [
            [
                'tahun_masuk' => 'ts_6',
                'jumlah_diterima' => 200,
                'jumlah_lulus_ts_6' => 200,
                'jumlah_lulus_ts_5' => 200,
                'jumlah_lulus_ts_4' => 200,
                'jumlah_lulus_ts_3' => 200,
                'jumlah_lulus_ts_2' => 200,
                'jumlah_lulus_ts_1' => 200,
                'jumlah_lulus_ts' => 200,
                'tautan' => 'https://example.com/tabel_k9_masa_studis',
                'prodi_id' => 123
            ]
        ];

        TabelK9MasaStudi::insert($masaStudi);
    }
}
