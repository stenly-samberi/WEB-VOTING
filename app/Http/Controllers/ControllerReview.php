<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class ControllerReview extends Controller
{
   
    public function index() {
        $registers = Peserta::with('data_jemaat', 'data_lagu', 'kategori_lomba')
                            ->whereNotNull('no_tampil')
                            ->where('no_tampil', '!=', '')
                            ->get()
                            ->unique('id_njemaat')
                            ->sortByDesc('no_tampil');

        // return $registers;
                            
        return view('html.voting', [
            'peserta' => $registers
        ]);
    }
}
