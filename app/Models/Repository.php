<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dokumen;

class Repository extends Model
{
    use HasFactory;

    protected $table = 'repository';

    public function documents()
    {
        return $this->hasMany(Dokumen::class);
    }
}


