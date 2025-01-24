<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TabalK9ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tabel_k9_produks')->insert([
            [
                'dosen_id' => '12345678',
                'nama_mahasiswa' => 'Rifki',
                'nama_produk' => 'Aplikasi Sekolah',
                'deskripsi' => 'Aplikasi untuk melakukan absensi, penilaian, dan monitoring kegiatan di sekolah',
                'tautan' => 'https://example.com/app-sekolah',
                'prodi_id' => '123'
            ],
            [
                'dosen_id' => '12345678',
                'nama_mahasiswa' => 'John',
                'nama_produk' => 'Website Perusahaan',
                'deskripsi' => 'Website perusahaan yang menampilkan profil perusahaan, produk, dan layanan',
                'tautan' => 'https://example.com/perusahaan',
                'prodi_id' => '123'
            ],
            [
                'dosen_id' => '34567890',
                'nama_mahasiswa' => 'Amy',
                'nama_produk' => 'Aplikasi E-Commerce',
                'deskripsi' => 'Aplikasi e-commerce untuk melakukan transaksi online',
                'tautan' => 'https://example.com/app-ecommerce',
                'prodi_id' => '123'
            ],
        ]);
    }
}
