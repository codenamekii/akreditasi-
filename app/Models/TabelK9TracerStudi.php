<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelK9TracerStudi extends Model
{
    use HasFactory;

    protected $table = 'tabel_k9_tracer_studis';

    protected $guarded = ['id'];

    protected $fillable = [];
}
