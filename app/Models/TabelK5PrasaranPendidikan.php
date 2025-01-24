<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK5PrasaranPendidikan extends Model
{
    use HasFactory;

    protected $table = "tabel_k5_prasarana_pendidikan";
    protected $guarded = ['id'];
}
