<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TabelK9IpkLulusan;

class TabelK9IpkLulusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TabelK9IpkLulusan::create([
            'tahun' => date('Y'),
            'jumlah_lulusan' => 100,
            'minimum' => 3.5,
            'rata_rata' => 3.5,
            'maksimum' => 4.0,
            'tautan' => 'link',
            'prodi_id' => 123
        ]);

        TabelK9IpkLulusan::create([
            'tahun' => date('Y') - 1,
            'jumlah_lulusan' => 150,
            'minimum' => 3.2,
            'rata_rata' => 3.5,
            'maksimum' => 4.0,
            'tautan' => 'link',
            'prodi_id' => 123
        ]);
    }
}
