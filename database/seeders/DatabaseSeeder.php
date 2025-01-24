<?php

namespace Database\Seeders;

// load MODEL
use App\Models\User;
use App\Models\dataProgramStudi;
use App\Models\dataKeuangan;
use App\Models\TabelDosen;
use App\Models\TabelK2BidangKelembagaan;
use App\Models\TabelK2BidangPendidikan;
use App\Models\TabelK2BidangPenelitian;
use App\Models\TabelK2BidangPkm;
use App\Models\TabelK3LayananPembinaanMahasiswa;
use App\Models\TabelK3MahasiswaDalamNegeri;
use App\Models\TabelK3MahasiswaLuarNegeri;
use App\Models\TabelK3MahasiswaReguler;
use App\Models\TabelK4BebanKerjaDTPS;
use App\Models\TabelK4BimbinganTA;
use App\Models\TabelK4DtpsKeahlianPS;
use App\Models\TabelK4DtpsLuarPS;
use App\Models\TabelK4KegiatanMengajar;
use App\Models\TabelK4KompetensiTendik;
use App\Models\TabelK4PengembanganKompetensiDTPS;
use App\Models\TabelK4PrestasiDTPS;
use App\Models\TabelK4Tendik;
use App\Models\TabelK5SaranaPendidikan;
use App\Models\TabelMatakuliah;
use App\Models\Fakultas;
// Library
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //data fakultas
    Fakultas::updateOrCreate(
      ['id' => 1],
      ['nama_fakultas' => 'Fakultas Teknik']
    );

    Fakultas::updateOrCreate(
      ['id' => 2],
      ['nama_fakultas' => 'Fakultas Pertanian']
    );


        dataProgramStudi::create([
            'id' => 232,
            'jenis' => 'S1',
            'nama' => 'Teknik Informatika',
            'status_peringkat' => 'BAIK SEKALI',
            'nomor_sk' => Str::random(5),
            'tanggal_sk' => '2019-01-01 12:12',
            'tanggal_kadaluarsa' => '2024-02-3 12:12',
            'jumlah_mhs_ts' => 1000,
            'jumlah_dtps_ts' => 1000,
            'rerata_ipk' => 3.8,
            'rerata_masa_studi' => 7.5,
            'fakultas_id' => 2,
        ]);
        
        // menjalankan faker class data program studi
        \App\Models\dataProgramStudi::factory(1)->create();
        \App\Models\dataProgramStudi::factory()->prodiTeknikMesin()->create();
        \App\Models\dataProgramStudi::factory()->prodiTeknikIndustri()->create();
        \App\Models\dataProgramStudi::factory()->prodiTeknikInformatika()->create();
        
      // menjalankan faker class user
        \App\Models\User::factory(1)->create();
        \App\Models\User::factory()->AdminProdiTeknikMesin()->create();
        \App\Models\User::factory()->AdminProdiTeknikIndustri()->create();
        \App\Models\User::factory()->AdminProdiTeknikInformatika()->create();
        \App\Models\User::factory()->asesor()->create();

        User::create([
            'name' => "admin root",
            'email' => "root@root.com",
            'email_verified_at' => now(),
            'role' => 'root',
            'prodi_id' => 1,
            'password' => bcrypt("qwerty123456!@#$%^"),
            'remember_token' => Str::random(10),
        ]);

        //data keuangan
        dataKeuangan::create([
          'tahun' => 2024,
          'pendidikan_per_mahasiswa' => 3000,
          'penelitian_per_dosen' => 10000,
          'pkm_per_dosen' => 8000,
          'publikasi_per_dosen' => 1500,
          'investasi' => 250000.50,
          'prodi_id' => 123,
          'tautan' => 'https://example.com',
      ]);

        dataKeuangan::create([
          'tahun' => 2024,
          'pendidikan_per_mahasiswa' => 5000,
          'penelitian_per_dosen' => 10000,
          'pkm_per_dosen' => 8000,
          'publikasi_per_dosen' => 1500,
          'investasi' => 250000.50,
          'prodi_id' => 123,
          'tautan' => 'https://example.com',
      ]);

        //K2 Kerjasama
        TabelK2BidangPendidikan::create([
            'nama_mitra' => 'Mitra Internasional 1',
            'tingkat' => 'Internasional',
            'judul_ruang_lingkup' => 'Ruang Lingkup Internasional 1',
            'manfaat_output' => 'Manfaat Output Internasional 1',
            'durasi' => 12,
            'tautan' => 'https://example.com/internasional-1',
        ]);

        TabelK2BidangPendidikan::create([
            'nama_mitra' => 'Mitra Nasional 1',
            'tingkat' => 'Nasional',
            'judul_ruang_lingkup' => 'Ruang Lingkup Nasional 1',
            'manfaat_output' => 'Manfaat Output Nasional 1',
            'durasi' => 8,
            'tautan' => '',
        ]);

        TabelK2BidangPenelitian::create([
            'nama_mitra' => 'Mitra Nasional 1',
            'tingkat' => 'Nasional',
            'judul_ruang_lingkup' => 'Ruang Lingkup Nasional 1',
            'manfaat_output' => 'Manfaat Output Nasional 1',
            'durasi' => 8,
            'tautan' => '',
        ]);
        TabelK2BidangPenelitian::create([
            'nama_mitra' => 'Mitra Nasional 3',
            'tingkat' => 'Lokal',
            'judul_ruang_lingkup' => 'Ruang Lingkup Lokal',
            'manfaat_output' => 'Manfaat LOKAL Ambon',
            'durasi' => 4,
            'tautan' => '',
        ]);
        TabelK2BidangPenelitian::create([
            'nama_mitra' => 'Mitra Regional ',
            'tingkat' => 'Internasional',
            'judul_ruang_lingkup' => 'Ruang Lingkup InterLokal',
            'manfaat_output' => 'Manfaat Internasional',
            'durasi' => 4,
            'tautan' => '',
        ]);


        TabelK2BidangPkm::create([
            'nama_mitra' => 'Mitra PKM Mltinasional ',
            'tingkat' => 'Internasional',
            'judul_ruang_lingkup' => 'Ruang Lingkup InterLokal',
            'manfaat_output' => 'Manfaat Internasional',
            'durasi' => 4,
            'tautan' => '',
        ]);
        TabelK2BidangPkm::create([
            'nama_mitra' => 'Mitra PKM Regional ',
            'tingkat' => 'Lokal',
            'judul_ruang_lingkup' => 'Ruang Lingkup InterLokal',
            'manfaat_output' => 'Manfaat Internasional',
            'durasi' => 2,
            'tautan' => '',
        ]);

        TabelK2BidangKelembagaan::create([
            'nama_mitra' => 'Kerjasama Antar Institut',
            'tingkat' => 'Lokal',
            'judul_ruang_lingkup' => 'Ruang Lingkup Regional X',
            'manfaat_output' => 'Manfaat Pengembangan Kelembagaan',
            'durasi' => 2,
            'tautan' => '',
        ]);
        TabelK2BidangKelembagaan::create([
            'nama_mitra' => 'IAIN Se Indonesia Timur',
            'tingkat' => 'Nasional',
            'judul_ruang_lingkup' => 'Regional X',
            'manfaat_output' => 'Manfaat Pengembangan Kelembagaan',
            'durasi' => 4,
            'tautan' => '',
        ]);

        TabelK3MahasiswaReguler::create([
            'tahun_akademik' => 2023,
            'daya_tampung' => 200,
            'pendaftar' => 250, 
            'lulus_seleksi' => 200,
            'jum_mahasiswa_baru' => 180,
            'total' => 200
        ]);
        TabelK3MahasiswaReguler::create([
            'tahun_akademik' => 2022,
            'daya_tampung' => 200,
            'pendaftar' => 350, 
            'lulus_seleksi' => 210,
            'jum_mahasiswa_baru' => 190,
            'total' => 200
        ]);
        TabelK3MahasiswaReguler::create([
            'tahun_akademik' => 2021,
            'daya_tampung' => 220,
            'pendaftar' => 350, 
            'lulus_seleksi' => 210,
            'jum_mahasiswa_baru' => 190,
            'total' => 200
        ]);

        TabelK3MahasiswaDalamNegeri::create([
            'tahun_akademik' => 2023,
            'jumlah_provinsi' => 2,
            'laki_laki' => 20,
            'perempuan' => 20,
        ]);
        TabelK3MahasiswaDalamNegeri::create([
            'tahun_akademik' => 2022,
            'jumlah_provinsi' => 3,
            'laki_laki' => 100,
            'perempuan' => 200,
        ]);
        TabelK3MahasiswaLuarNegeri::create([
            'tahun_akademik' => 2023,
            'jumlah_negara' => 10,
            'laki_laki' => 100,
            'perempuan' => 120,
            'total_mahasiswa' => 220,
            'tautan' => 'http://example.com',
                'prodi_id' => 123, // Ensure this ID exists in the data_program_studis table
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'tahun_akademik' => 2024,
                'jumlah_negara' => 15,
                'laki_laki' => 110,
                'perempuan' => 130,
                'total_mahasiswa' => 240,
                'tautan' => null,
                'prodi_id' => 123,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        TabelK3LayananPembinaanMahasiswa::create([
            'tahun_akademik' => 2021,
            'minat' => 3,
            'bakat' => 200,
            'penalaran' => 200,
            'kesejahteraan' => 200,
            'keprofesian' => 200
        ]);
        TabelK3LayananPembinaanMahasiswa::create([
            'tahun_akademik' => 2023,
            'minat' => 4,
            'bakat' => 20,
            'penalaran' => 2,
            'kesejahteraan' => 2,
            'keprofesian' => 2
        ]);

        TabelK4DtpsKeahlianPS::create([
            'nama' => 'Jono',
            'nidn_nidk' => '3',
            'tanggal_lahir' => '1997-01-01',
            'sertifikat_pendidik' => 'ada',
            'jabatan_fungsional' => 'Lektor',
            'gelar_akademik' => 'Doktor',
            'pendidikan' => 'S1 Sistem Informasi, S2 Teknik Informatika, S3 Manajemen pendidikan',
            'bidang_keahlian' => 'Manajemen Pendidikan', 
            'sesuai_ps' => 'tidak', 
            'prodi_id' => 123
            
        ]);
        TabelDosen::create([
            'nama' => 'Lono',
            'nidn_nidk' => '1',
            'tanggal_lahir' => '1994-01-01',
            'sertifikat_pendidik' => 'ada',
            'jabatan_fungsional' => 'Lektor',
            'gelar_akademik' => 'S3',
            'pendidikan' => 'S1 Sistem Informasi, S2 Teknik Informatika, S3 Manajemen pendidikan',
            'bidang_keahlian' => 'Manajemen Pendidikan', 
            'sesuai_ps' => 'ya', 
            'prodi_id' => 123
        ]);
        TabelDosen::create([
            'nama' => 'Joni',
            'nidn_nidk' => '2',
            'tanggal_lahir' => '1993-01-01',
            'sertifikat_pendidik' => 'belum ada',
            'jabatan_fungsional' => 'Lektor Kepala',
            'gelar_akademik' => 'S3',
            'pendidikan' => 'S1 Sistem Informasi, S2 Teknologi Informasi, S3 Manajemen Sistem Informasi',
            'bidang_keahlian' => 'Teknologi Informasi', 
            'sesuai_ps' => 'ya', 
            'prodi_id' => 123
        ]);
        TabelDosen::create([
            'nama' => 'Joni',
            'nidn_nidk' => '4',
            'tanggal_lahir' => '1993-01-01',
            'sertifikat_pendidik' => 'belum ada',
            'jabatan_fungsional' => 'Lektor Kepala',
            'gelar_akademik' => 'S3',
            'pendidikan' => 'S1 Sistem Informasi, S2 Teknologi Informasi, S3 Manajemen Sistem Informasi',
            'bidang_keahlian' => 'Teknologi Informasi', 
            'sesuai_ps' => 'tidak', 
            'prodi_id' => 321,
        ]);
        TabelDosen::create([
            'nama' => 'Joni',
            'nidn_nidk' => '5',
            'tanggal_lahir' => '1993-01-01',
            'sertifikat_pendidik' => 'belum ada',
            'jabatan_fungsional' => 'Lektor Kepala',
            'gelar_akademik' => 'S3',
            'pendidikan' => 'S1 Sistem Informasi, S2 Teknologi Informasi, S3 Manajemen Sistem Informasi',
            'bidang_keahlian' => 'Teknologi Informasi', 
            'sesuai_ps' => 'tidak', 
            'prodi_id' => 321,
        ]);

        TabelK4BebanKerjaDTPS::create([
            'nidn_nidk' => '1',
            'sks_ps_sendiri' => '3',
            'sks_ps_luar' => '3',
            'sks_pt_luar' => '3',
            'sks_penelitian' => '3',
            'sks_p2m' => '3',
            'sks_manajemen_sendiri' => '3',
            'sks_manajemen_luar' => '3',
        ]);
        TabelK4BebanKerjaDTPS::create([
            'nidn_nidk' => '2',
            'sks_ps_sendiri' => '3',
            'sks_ps_luar' => '3',
            'sks_pt_luar' => '3',
            'sks_penelitian' => '3',
            'sks_p2m' => '3',
            'sks_manajemen_sendiri' => '3',
            'sks_manajemen_luar' => '3',
        ]);
        TabelK4BebanKerjaDTPS::create([
            'nidn_nidk' => '3',
            'sks_ps_sendiri' => '3',
            'sks_ps_luar' => '3',
            'sks_pt_luar' => '3',
            'sks_penelitian' => '3',
            'sks_p2m' => '3',
            'sks_manajemen_sendiri' => '3',
            'sks_manajemen_luar' => '3',
        ]);
        TabelK4KegiatanMengajar::create([
            'nidn_nidk' => '3',
            'jumlah_kelas' => '3',
            'kode_mk' => '1',
            'jum_pertemuan_rencana' => 16,
            'jum_pertemuan_terlaksana' => 16,
            'semester' => 'Gasal',
        ]);
        TabelK4KegiatanMengajar::create([
            'nidn_nidk' => '2',
            'jumlah_kelas' => '2',
            'kode_mk' => '2',
            'jum_pertemuan_rencana' => 16,
            'jum_pertemuan_terlaksana' => 16,
            'semester' => 'Gasal',
        ]);
        TabelK4KegiatanMengajar::create([
            'nidn_nidk' => '2',
            'jumlah_kelas' => '2',
            'kode_mk' => '3',
            'jum_pertemuan_rencana' => 16,
            'jum_pertemuan_terlaksana' => 16,
            'semester' => 'Genap',
        ]);

        TabelK4BimbinganTA::create([
            'nidn_nidk' => '2',
            'ts_2' => '2',
            'ts_1' => '2',
            'ts' => '3',
            'tautan' => '#',
        ]);
        TabelK4BimbinganTA::create([
            'nidn_nidk' => '1',
            'ts_2' => '2',
            'ts_1' => '3',
            'ts' => '1',
            'tautan' => '#',
        ]);
        TabelK4BimbinganTA::create([
            'nidn_nidk' => '3',
            'ts_2' => '2',
            'ts_1' => '2',
            'ts' => '2',
            'tautan' => '#',
        ]);
        TabelK4PrestasiDTPS::create([
            'nidn_nidk' => '3',
            'prestasi' => "Keynote Speaker Seminar Internasional Jenis Ikan Dasar",
            'tahun' => '2023',
            'tautan' => "http://www.iainambon.ac.id/",
        ]);
        TabelK4PrestasiDTPS::create([
            'nidn_nidk' => '3',
            'prestasi' => "Keynote Speaker Seminar Nasional Jenis Ikan Dasar",
            'tahun' => '2023',
            'tingkat' => 'Nasional',
            'tautan' => "http://www.iainambon.ac.id/",
        ]);
        TabelK4PengembanganKompetensiDTPS::create([ 
            'nidn_nidk' => '3',
            'bidang_keahlian' => 'Pendidikan',
            'nama_kegiatan' => 'PPG',
            'tempat' => 'IAIN Ambon',
            'waktu' => '2024-02-01',
            'manfaat' => 'Pengembangan diri',
            'tautan' => '#',
        ]);
        TabelK4PengembanganKompetensiDTPS::create([ 
            'nidn_nidk' => '2',
            'bidang_keahlian' => 'Pendidikan',
            'nama_kegiatan' => 'PPG',
            'tempat' => 'IAIN Ambon',
            'waktu' => '2023-02-01',
            'manfaat' => 'Pengembangan diri',
            'tautan' => '#',
        ]);
        TabelK4PengembanganKompetensiDTPS::create([ 
            'nidn_nidk' => '2',
            'bidang_keahlian' => 'Pendidikan',
            'nama_kegiatan' => 'PPG',
            'tempat' => 'IAIN Ambon',
            'waktu' => '2024-02-01',
            'manfaat' => 'Pengembangan diri',
            'tautan' => '#',
        ]);
        TabelK4Tendik::create([
            'id_tendik'=>'11',
            'nama'=>'Andi Bedu',
            'status'=>'PNS',
            'bidang_keahlian'=>'Administrasi',
            'pendidikan'=>'Diploma',
            'unit_kerja'=>'PS',
            'tautan'=>'#',
        ]);
        TabelK4Tendik::create([
            'id_tendik'=>'22',
            'nama'=>'Mas Toni',
            'status'=>'Non PNS',
            'bidang_keahlian'=>'Laboran',
            'pendidikan'=>'S1',
            'unit_kerja'=>'UPPS',
            'tautan'=>'#',
        ]);
        TabelK4Tendik::create([
            'id_tendik'=>'33',
            'nama'=>'UDA Sederhana',
            'status'=>'Pegawai tetap Kontrak',
            'bidang_keahlian'=>'Laboran',
            'pendidikan'=>'S1',
            'unit_kerja'=>'PT',
            'tautan'=>'#',
        ]);
        TabelK4KompetensiTendik::create([
            'id_tendik' => '11',
            'nama_kegiatan' => 'Pelatihan kompetensi penguasaan IT',
            'waktu_mulai' => '2024-01-01',
            'waktu_selesai' => '2024-01-10',
            'tempat' => 'ITB Stikom Ambon',
            'tautan' => '#',
        ]);
        TabelK4KompetensiTendik::create([
            'id_tendik' => '22',
            'nama_kegiatan' => 'Pelatihan kompetensi penguasaan IT',
            'waktu_mulai' => '2023-03-06',
            'waktu_selesai' => '2023-03-10',
            'tempat' => 'ITB Stikom Ambon',
            'tautan' => '#',
        ]);
        TabelK4KompetensiTendik::create([
            'id_tendik' => '33',
            'nama_kegiatan' => 'Pelatihan kompetensi penguasaan IT',
            'waktu_mulai' => '2023-08-07',
            'waktu_selesai' => '2023-08-10',
            'tempat' => 'ITB Stikom Ambon',
            'tautan' => '#',
        ]);

        TabelMatakuliah::create([
            'kode_mk' => '1',
            'nama' => 'Pengantar Tauhid',
            'semester' => 1,
            'prodi_id' => 123,
            'sks' => 3,
        ]);
        TabelMatakuliah::create([
            'kode_mk' => '2',
            'nama' => 'Pengantar Tauhid 2',
            'semester' => 2,
            'prodi_id' => 123,
            'sks' => 3,
        ]);
        TabelMatakuliah::create([
            'kode_mk' => '3',
            'nama' => 'Fiqih Kontemporer',
            'semester' => 2,
            'sks' => 3,
            'prodi_id' => 123,
        ]);

        $this->call(tabelDosenSeeder::class);

        // Tabel kriteria 9
        $this->call(TabelK9IpkLulusanSeeder::class);
        $this->call(TabelK9PrestasiMahasiswaSeeder::class);
        $this->call(TabelK9TracerStudiSeeder::class);
        $this->call(TabelK9RelevansiPekerjaanSeeder::class);
        $this->call(TabalK9KaryaDisitasiSeeder::class);
        $this->call(TabalK9ProdukSeeder::class);
        $this->call(TabalK9ProdukHkiSeeder::class);
        $this->call(TabalK9KepuasanPenggunaSeeder::class);
        $this->call(TabelK9MasaStudiSeeder::class);
        $this->call(TabalK9PublikasiSeeder::class);

        $this->call(K5Seeder::class);
    }
}
