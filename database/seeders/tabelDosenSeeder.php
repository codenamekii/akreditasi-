<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Dosen;

class tabelDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nidn_nidk' => '12345678', 'nama' => 'Agung Eko Susilo', 'tanggal_lahir' => '1999-1-1', 'sertifikat_pendidik' => 'D3', 'jabatan_fungsional' => 'Lektor', 'gelar_akademik' => 'S.Kom', 'pendidikan' => 'S1', 'bidang_keahlian' => 'Teknologi Informasi', 'prodi_id' => 123],
            ['nidn_nidk' => '23456789', 'nama' => 'Ari Susanto', 'tanggal_lahir' => '2000-1-1', 'sertifikat_pendidik' => 'S1', 'jabatan_fungsional' => 'Lektor Kepala', 'gelar_akademik' => 'S.Kom', 'pendidikan' => 'S2', 'bidang_keahlian' => 'Teknologi Informasi', 'prodi_id' => 123],
            ['nidn_nidk' => '34567890', 'nama' => 'Dedy Tri Pambudi', 'tanggal_lahir' => '2001-1-1', 'sertifikat_pendidik' => 'S2', 'jabatan_fungsional' => 'Guru Besar', 'gelar_akademik' => 'S.Kom', 'pendidikan' => 'S3', 'bidang_keahlian' => 'Teknologi Informasi', 'prodi_id' => 123],
            ['nidn_nidk' => '45678901', 'nama' => 'Dewi Sukmawati', 'tanggal_lahir' => '2002-1-1', 'sertifikat_pendidik' => 'S3', 'jabatan_fungsional' => 'Guru Besar', 'gelar_akademik' => 'S.Kom', 'pendidikan' => 'S1', 'bidang_keahlian' => 'Teknologi Informasi', 'prodi_id' => 123],
            ['nidn_nidk' => '56789012', 'nama' => 'Eko Purwanto', 'tanggal_lahir' => '2003-1-1', 'sertifikat_pendidik' => 'S1', 'jabatan_fungsional' => 'Lektor', 'gelar_akademik' => 'S.Kom', 'pendidikan' => 'S3', 'bidang_keahlian' => 'Teknologi Informasi', 'prodi_id' => 123],
        ];
        DB::table('tabel_dosen')->insert($data);
    }
}
