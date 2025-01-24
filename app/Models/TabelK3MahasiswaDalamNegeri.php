<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK3MahasiswaDalamNegeri extends Model
{
    use HasFactory;

    protected $table = "tabel_k3_mhs_dalam_negeri";
    protected $guarded = ['id'];
}
