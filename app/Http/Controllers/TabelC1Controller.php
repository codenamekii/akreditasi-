<?php

namespace App\Http\Controllers;

use App\Mail\AkunCreated;
use Illuminate\Http\Request;

class TabelC1Controller extends Controller
{
    protected $akunController;

    public function __construct()
    {
        $this->akunController = new AkunController();
    }

    public function index()
    {
        return view ('kriteria.c1.index');
    }

    

}
