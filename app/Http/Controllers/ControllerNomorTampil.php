<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Review;
use Illuminate\Http\Request;

class ControllerNomorTampil extends Controller
{
    public function index() {
        return view('html.nomor_tampil');
    }

    public function getData(){
        $registers = Peserta::with('data_jemaat', 'data_lagu', 'kategori_lomba')
                            ->whereNotNull('no_tampil')
                            ->where('no_tampil', '!=', '')
                            ->orderBy('id_kategori_lomba') // Mengurutkan berdasarkan kategori lomba
                            ->orderBy('no_tampil') // Mengurutkan berdasarkan nomor tampil dalam setiap kategori
                            ->get(); // Pastikan ini sesuai dengan kebutuhan Anda

        return response()->json($registers);
    }

public function updated_status(Request $request){ 
       
        $id = $request->input('id');
        $statusValue = $request->input('status') === 'true';
        $peserta = Peserta::where('id_register', $id)->firstOrFail();
        $peserta->status = $statusValue;
        $peserta->save();
        return response()->json(['message' => 'Status updated successfully']);
    }
    
    
public function generateRandomOrder(){
    // Mengambil semua peserta dan mengelompokkan berdasarkan id_kategori_lomba
    $pesertaGroupedByKategori = Peserta::all()->groupBy('id_kategori_lomba');

    foreach ($pesertaGroupedByKategori as $idKategori => $pesertaGroup) {
        // Mengacak urutan peserta
        $pesertaGroup = $pesertaGroup->shuffle();

        // Mengupdate no_tampil untuk setiap peserta dalam kategori
        foreach ($pesertaGroup as $index => $peserta) {
            $noUrut = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
            $peserta->update(['no_tampil' => $noUrut]);
        }
    }
    return redirect()->route('nomor_tampil.index')->with('success', 'Nomor urut peserta berhasil dibuat');
}

    public function reset(){
        Peserta::query()->update(['no_tampil' => 0]);
        return redirect()->back()->with('success', 'Nomor Berhasil di Reset');
    }

    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
