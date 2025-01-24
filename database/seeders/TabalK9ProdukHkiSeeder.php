<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TabalK9ProdukHkiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tabel_k9_produk_hkis')->insert([
            ['dosen_id' => '12345678', 'nama_mahasiswa' => 'nama 1', 'identitas_produk' => 'produk 1', 'tahun' => '2020', 'tautan' => 'tautan 1', 'prodi_id' => '123'],
            ['dosen_id' => '34567890', 'nama_mahasiswa' => 'nama 2', 'identitas_produk' => 'produk 2', 'tahun' => '2021', 'tautan' => 'tautan 2', 'prodi_id' => '123'],
            ['dosen_id' => '34567890', 'nama_mahasiswa' => 'nama 3', 'identitas_produk' => 'produk 3', 'tahun' => '2022', 'tautan' => 'tautan 3', 'prodi_id' => '123'],
            ['dosen_id' => '45678901', 'nama_mahasiswa' => 'nama 4', 'identitas_produk' => 'produk 4', 'tahun' => '2023', 'tautan' => 'tautan 4', 'prodi_id' => '123'],
            ['dosen_id' => '56789012', 'nama_mahasiswa' => 'nama 5', 'identitas_produk' => 'produk 5', 'tahun' => '2024', 'tautan' => 'tautan 5', 'prodi_id' => '123'],
        ]);
    }
}
