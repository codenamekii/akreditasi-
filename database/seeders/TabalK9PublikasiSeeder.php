<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TabelK9Publikasi;

class TabalK9PublikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TabelK9Publikasi::create([
            'jenis' => 'Artikel di jurnal nasional ber-ISSN',
            'jumlah_ts_2' => 2,
            'jumlah_ts_1' => 2,
            'jumlah_ts' => 2,
            'jumlah' => 2,
            'tautan' => '#',
            'prodi_id' => 123,
        ]);
    }
}
