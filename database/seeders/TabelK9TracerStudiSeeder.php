<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TabelK9TracerStudi;


class TabelK9TracerStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TabelK9TracerStudi::create([
            'tahun_lulus' => date('Y') - 1,
            'jumlah_lulusan' => 123,
            'jumlah_terlacak' => 12,
            'waktu_tunggu_wt3' => 1,
            'waktu_tunggu_wt36' => 2,
            'waktu_tunggu_wt612' => 3,
            'waktu_tunggu_wt12' => 4,
            'tautan' => 'https://example.com/tabel_k9_tracer_studis',
            'prodi_id' => 123,
        ]);

        TabelK9TracerStudi::create([
            'tahun_lulus' => date('Y'),
            'jumlah_lulusan' => 123,
            'jumlah_terlacak' => 12,
            'waktu_tunggu_wt3' => 1,
            'waktu_tunggu_wt36' => 2,
            'waktu_tunggu_wt612' => 3,
            'waktu_tunggu_wt12' => 4,
            'tautan' => 'https://example.com/tabel_k9_tracer_studis',
            'prodi_id' => 123,
        ]);

    }
}
