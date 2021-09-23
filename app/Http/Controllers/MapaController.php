<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper; 

class MapaController extends Controller
{
    public function index()
    {
        Mapper::map(0,0);
        return view('mapa.index'); 
    }

}
