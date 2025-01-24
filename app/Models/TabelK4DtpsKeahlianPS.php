<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK4DtpsKeahlianPS extends Model
{
    use HasFactory;

    protected $table = "tabel_dosen";
    protected $guarded = ['id'];
}
