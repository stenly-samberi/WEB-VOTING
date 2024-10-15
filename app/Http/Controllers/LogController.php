<?php

namespace App\Http\Controllers;
use App\Models\KategoriLomba;
use App\Models\DataJemaat;
use Illuminate\Http\Request;

class LogController extends Controller
{
    
    public function jemaat(){
        $jemaat = DataJemaat::all();
        return response()->json(['data' => $jemaat]);
    }

    public function kategori(){
        $kategori = KategoriLomba::all();
        return response()->json(['data' => $kategori]);
    }
}
