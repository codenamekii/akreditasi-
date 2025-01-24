<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class dataProgramStudiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // data prodi default
            'id' => 1,
            'jenis' => 'S1',
            'nama' => $this->faker->name(),
            'status_peringkat' => 'BAIK SEKALI',
            'nomor_sk' => Str::random(5),
            'tanggal_sk' => '2019-01-01 12:12',
            'tanggal_kadaluarsa' => '2024-02-3 12:12',
            'jumlah_mhs_ts' => 1000,
            'jumlah_dtps_ts' => 1000,
            'rerata_ipk' => 3.8,
            'rerata_masa_studi' => 7.5,
            'fakultas_id' => 1,

        ];
    }

    public function prodiTeknikMesin()
    {
            return $this->state(function (array $attributes) { 
            return [
            // data prodi default
            'id' => 123,
            'jenis' => 'S1',
            'nama' => 'Teknik Mesin',
            'status_peringkat' => 'BAIK SEKALI',
            'nomor_sk' => Str::random(5),
            'tanggal_sk' => '2019-01-01 12:12',
            'tanggal_kadaluarsa' => '2024-02-3 12:12',
            'jumlah_mhs_ts' => 1000,
            'jumlah_dtps_ts' => 1000,
            'rerata_ipk' => 3.8,
            'rerata_masa_studi' => 7.5,
            'fakultas_id' => 1,

        ];
        });
        
    }

    
    public function prodiTeknikIndustri()
    {
          return $this->state(function (array $attributes) { 
            return [
            // data prodi default
            'id' => 321,
            'jenis' => 'S1',
            'nama' => 'Teknik Industri',
            'status_peringkat' => 'BAIK SEKALI',
            'nomor_sk' => Str::random(5),
            'tanggal_sk' => '2019-01-01 12:12',
            'tanggal_kadaluarsa' => '2024-02-3 12:12',
            'jumlah_mhs_ts' => 1000,
            'jumlah_dtps_ts' => 1000,
            'rerata_ipk' => 3.8,
            'rerata_masa_studi' => 7.5,
            'fakultas_id' => 1,

        ];
        });
        
    }

  public function prodiTeknikInformatika()
  {
    return $this->state(function (array $attributes) {
      return [
        // data prodi default
        'id' => 231,
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
        'fakultas_id' => 1,

      ];
    });
  }
    
}
