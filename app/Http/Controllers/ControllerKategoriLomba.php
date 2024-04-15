<?php

namespace App\Http\Controllers;

use App\Models\KategoriLomba;
use Illuminate\Http\Request;

class ControllerKategoriLomba extends Controller
{
    public function index(){
        // $genre = GenreLagu::paginate(5);
        $lomba = KategoriLomba::all();

        return view('html.kategori_lomba', [
            'lomba' => $lomba
        ]);
    }

    public function store( Request $request){

        // return $request;

        $validatedData = $request->validate([
            'kategori_lomba' => 'required|string|max:255'
        ]);

        try {
            KategoriLomba::create([
                'kategori_lomba' => ucwords($validatedData['kategori_lomba'])
               
            ]);
            return redirect()->route('kategori_lomba.index')->with('success', 'Data has been successfully.');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan kategori.']);
        }
        
    }

    public function destroy($id)
    {
        $kategori = KategoriLomba::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori_lomba.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
