<?php

namespace Database\Seeders;

use App\Models\TabelK5DanaPKM;
use App\Models\TabelK5PrasaranPendidikan;
use App\Models\TabelK5SaranaPendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class K5Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TabelK5DanaPKM::create([
            'judul_pkm' => "Pengembangan SISTEM eAkreditasi",
            'nidn_nidk' => '1',
            'sumber_dana' => 'DIPA PKM 2024',
            'jumlah_dana_ts2' => 200000,
            'jumlah_dana_ts1' => 150000,
            'jumlah_dana_ts' => 123,
            'prodi_id' => 123,
            'tautan' => '#',
        ]);
        TabelK5DanaPKM::create([
            'judul_pkm' => "Penanaman prinsip ketauhidan pada generasi Z di Ambon",
            'nidn_nidk' => '1',
            'sumber_dana' => 'DIPA PKM 2024',
            'jumlah_dana_ts2' => 2000000,
            'jumlah_dana_ts1' => 1500000,
            'jumlah_dana_ts' => 123,
            'tautan' => '#',
            'prodi_id' => 123,
        ]);
        TabelK5SaranaPendidikan::create([
            'jenis_sarana' => 'Meja Kantor',
            'kualitas' => 'Baik',
            'jumlah_unit' => 2,
            'kondisi' => 'terawat',
            'unit_pengelola' => 'PS',
            'tautan' => '#',
            'prodi_id' => 123,
        ]);
        TabelK5SaranaPendidikan::create([
            'jenis_sarana' => 'Meja Kantor',
            'jumlah_unit' => 2,
            'kualitas' => 'Kurang Baik',
            'kondisi' => 'terawat',
            'unit_pengelola' => 'UPPS',
            'tautan' => '#',
            'prodi_id' => 123,
        ]);
        TabelK5PrasaranPendidikan::create([
            'jenis_prasarana' => 'Gedung HALL',
            'jumlah_unit' => '2',
            'luas' => 120,
            'prodi_id' => 123,
        ]);
    }
}
