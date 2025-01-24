<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TabelK9KepuasanPengguna;

class TabalK9KepuasanPenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $kemampuan = [
            'Etika berperilaku',
            'Kinerja yang terkait dengan kompetensi utama',
            'Kemampuan bekerja dalam tim',
            'Kemampuan berkomunikasi',
            'Kemampuan berbahasa Inggris',
            'Upaya pengembangan diri',
        ];

        foreach ($kemampuan as $item) {
            TabelK9KepuasanPengguna::create([
                'jenis_kemampuan' => $item,
                'sangat_baik' => 50.6,
                'baik' => 50.6,
                'cukup' => 50.6,
                'kurang' => 50.6,
                'tindak_lanjut' => 'tindak lanjut UPPS',
                'prodi_id' => 123,
            ]);
        }
    }
}
