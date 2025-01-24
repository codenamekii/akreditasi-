<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataKeuangan extends Model
{
    use HasFactory;
    
    protected $table = 'data_keuangans';

    protected $guarded = ['id'];

    protected $fillable = [];
}
