<?php

namespace App\Http\Controllers;

use App\Models\KategoriJemaat;
use Illuminate\Http\Request;

class ControllerKategoriJemaat extends Controller
{


    public function index()
    {
        $kategoriJemaat = KategoriJemaat::all();
        return view('html.kategori_gereja', [
            'kategoriJemaat' => $kategoriJemaat
        ]);
    }

    public function store( Request $request){

        $validatedData = $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        try {
            KategoriJemaat::create([
                'kategori' => ucwords($validatedData['kategori']),
            ]);
            return redirect()->route('kategori_jemaat.index')->with('success', 'Kategori berhasil ditambahkan.');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan kategori.']);
        }
        
    }

    public function destroy($id)
    {
        $kategori = KategoriJemaat::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori_jemaat.index')->with('success', 'Kategori berhasil dihapus.');
    }

    

}
