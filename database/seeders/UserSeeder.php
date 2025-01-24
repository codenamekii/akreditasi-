<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // menjalankan faker class data program studi
        \App\Models\dataProgramStudi::factory(1)->create();
      // menjalankan faker class user
        \App\Models\User::factory(1)->create();
    }
}
