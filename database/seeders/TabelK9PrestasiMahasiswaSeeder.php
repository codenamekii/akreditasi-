<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\TabelK9PrestasiMahasiswa;

class TabelK9PrestasiMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TabelK9PrestasiMahasiswa::create([
            'nama_mahasiswa' => 'Fadli wattiheluw', 'prestasi' => 'Beasiswa', 'waktu' => '2023-01-01',
            'tingkat' => 'internasional', 'tautan' => 'https://beasiswa.example.com', 'prodi_id' => 123
        ]);
        TabelK9PrestasiMahasiswa::create([
            'nama_mahasiswa' => 'Ikbal siami', 'prestasi' => 'Lomba', 'waktu' => '2023-02-01',
            'tingkat' => 'nasional', 'tautan' => 'https://lomba.example.com', 'prodi_id' => 123
        ]);
        TabelK9PrestasiMahasiswa::create([
            'nama_mahasiswa' => 'Mawadah hamid', 'prestasi' => 'Kompetisi', 'waktu' => '2023-03-01',
            'tingkat' => 'lokal', 'tautan' => 'https://kompetisi.example.com', 'prodi_id' => 123
        ]);
    }
}
