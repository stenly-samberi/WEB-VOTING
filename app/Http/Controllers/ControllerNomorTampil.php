<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class ControllerNomorTampil extends Controller
{
    public function index() {
        $registers = Peserta::with('data_jemaat', 'data_lagu', 'kategori_lomba')
                            ->whereNotNull('no_tampil')
                            ->where('no_tampil', '!=', '')
                            ->get()
                            ->unique('id_njemaat');
    
        return view('html.nomor_tampil', [
            'peserta' => $registers
        ]);
    }
    
    

    public function generateRandomOrder(){
        $peserta = Peserta::all()->unique('id_njemaat');
        $pesertaIds = $peserta->pluck('id_njemaat')->toArray();
        shuffle($pesertaIds);

        foreach ($pesertaIds as $index => $pesertaId) {
            $noUrut = str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            Peserta::where('id_njemaat', $pesertaId)->update(['no_tampil' => $noUrut]);
        }

        return redirect()->route('nomor_tampil.index')->with('success', 'Nomor urut peserta berhasil dibuat');
        }
}
