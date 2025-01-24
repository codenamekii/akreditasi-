<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // merupakan user default untuk admin fakutlas
        // admin fakultas tidak bisa di tambahkan
        return [
            'name' => "Admin Fakultas",
            'email' => "fakultas@admin.ac.id",
            'email_verified_at' => now(),
            'role' => 'fakultas',
            'prodi_id' => 1,
            'password' => bcrypt("admin"),
            'remember_token' => Str::random(10),
        ];
    }

    public function AdminProdiTeknikMesin()
    {
        // merupakan user default untuk admin fakutlas
        // admin fakultas tidak bisa di tambahkan
        return $this->state(function (array $attributes) {
            return [
                'name' => "Admin prodi Teknik Mesin",
                'email' => "mesin@admin.ac.id",
                'email_verified_at' => now(),
                'role' => 'admin prodi',
                'prodi_id' => 123,
                'password' => bcrypt("123123123"),
                'remember_token' => Str::random(10),
            ];
        });

    }


    public function AdminProdiTeknikIndustri()
    {
        // merupakan user default untuk admin fakutlas
        // admin fakultas tidak bisa di tambahkan
        return $this->state(function (array $attributes) {
            return [
                'name' => "Admin prodi Teknik Industri",
                'email' => "industri@admin.ac.id",
                'email_verified_at' => now(),
                'role' => 'admin prodi',
                'prodi_id' => 321,
                'password' => bcrypt("123123123"),
                'remember_token' => Str::random(10),
            ];
        });

    }

  public function AdminProdiTeknikInformatika()
  {
    // merupakan user default untuk admin fakutlas
    // admin fakultas tidak bisa di tambahkan
    return $this->state(function (array $attributes) {
      return [
        'name' => "Admin prodi Teknik Informatika",
        'email' => "informatika@admin.ac.id",
        'email_verified_at' => now(),
        'role' => 'admin prodi',
        'prodi_id' => 231,
        'password' => bcrypt("123123123"),
        'remember_token' => Str::random(10),
      ];
    });
  }

    public function asesor()
    {
        // merupakan user default untuk admin fakutlas
        // admin fakultas tidak bisa di tambahkan
        return $this->state(function (array $attributes) {
            return [
                'name' => "Asesor Prodi Teknik Industri",
                'email' => "asesorprodiindustri@admin.ac.id",
                'email_verified_at' => now(),
                'role' => 'asesor',
                'prodi_id' => 321,
                'password' => bcrypt("123123123"),
                'remember_token' => Str::random(10),
            ];
        });

    }






    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
