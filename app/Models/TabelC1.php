<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelC1 extends Model
{
    use HasFactory;


    protected $fillable = [
        'visi_misi',
        'prodi'
    ];
}
