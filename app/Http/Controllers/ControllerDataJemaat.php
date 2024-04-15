<?php

namespace App\Http\Controllers;

use App\Models\DataJemaat;
use App\Models\KategoriJemaat;
use Illuminate\Http\Request;

class ControllerDataJemaat extends Controller
{
    public function index()
    {
        $kategori = KategoriJemaat::all();

        $datajemaat = DataJemaat::with('kategori_jemaat')->get();
  
        // return $datajemaat;
    
        return view('html.nama_gereja', [
            'datajemaat' => $datajemaat,
            'datakategori' => $kategori
        ]);
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' =>'required|integer|max:255'
        ]);

        try {
            DataJemaat::create([
                'nama' => ucwords($validatedData['nama']),
                'id_kjemaat' => ucwords($validatedData['kategori']),
            ]);
            return redirect()->route('data_jemaat.index')->with('success', 'Kategori berhasil ditambahkan.');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan Data Jemaat.'.$e->getMessage()]);
        }
        
    }

    public function destroy($id)
    {
        $kategori = DataJemaat::findOrFail($id);
        $kategori->delete();
        return redirect()->route('data_jemaat.index')->with('success', 'Data Jemaat berhasil dihapus.');
    }

}
