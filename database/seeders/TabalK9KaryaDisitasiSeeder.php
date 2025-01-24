<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


use App\Models\TabelK9KaryaDisitasi;

class TabalK9KaryaDisitasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TabelK9KaryaDisitasi::insert([
            ['penulis_dosen_id' => '12345678', 'penulis_mahasiswa' => '123456789', 'judul' => 'judul 1', 'tahun' => '2020', 'nama_penerbit' => 'penerbit 1', 'nomor_halaman' => 'halaman 1', 'jumlah_sitasi' => 1, 'tautan' => 'tautan 1', 'prodi_id' => '123'],
            ['penulis_dosen_id' => '12345678', 'penulis_mahasiswa' => '123456788', 'judul' => 'judul 2', 'tahun' => '2021', 'nama_penerbit' => 'penerbit 2', 'nomor_halaman' => 'halaman 2', 'jumlah_sitasi' => 2, 'tautan' => 'tautan 2', 'prodi_id' => '123'],
            ['penulis_dosen_id' => '23456789', 'penulis_mahasiswa' => '123456787', 'judul' => 'judul 3', 'tahun' => '2022', 'nama_penerbit' => 'penerbit 3', 'nomor_halaman' => 'halaman 3', 'jumlah_sitasi' => 3, 'tautan' => 'tautan 3', 'prodi_id' => '123'],
            ['penulis_dosen_id' => '23456789', 'penulis_mahasiswa' => '123456786', 'judul' => 'judul 4', 'tahun' => '2023', 'nama_penerbit' => 'penerbit 4', 'nomor_halaman' => 'halaman 4', 'jumlah_sitasi' => 4, 'tautan' => 'tautan 4', 'prodi_id' => '123'],
            ['penulis_dosen_id' => '34567890', 'penulis_mahasiswa' => '123456785', 'judul' => 'judul 5', 'tahun' => '2024', 'nama_penerbit' => 'penerbit 5', 'nomor_halaman' => 'halaman 5', 'jumlah_sitasi' => 5, 'tautan' => 'tautan 5', 'prodi_id' => '123'],
        ]);
    }
}
