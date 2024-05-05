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

    public function edit(Request $request){

       $datajemaat = DataJemaat::find($request->idj);
       $datakategori = KategoriJemaat::all();
      
        return view('html.edit_gereja', [
            'datajemaat' => $datajemaat,
            'datakategori' => $datakategori
        ]);
    }

    public function updated(Request $request)
        {
            try {
                $request->validate([
                    'nama' => 'required|string|max:255',
                    'kategori' => 'required|integer',
                ]);

                $peserta = DataJemaat::find($request->id_jemaat);
                $peserta->nama = $request->nama; 
                $peserta->id_kjemaat = $request->kategori; 
                $peserta->save();

                return redirect()->route('data_jemaat.index')->with('success', 'Data berhasil diperbarui');
            
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Gagal Updated Data Jemaat.'.$e->getMessage()]);
            }
        }

}
