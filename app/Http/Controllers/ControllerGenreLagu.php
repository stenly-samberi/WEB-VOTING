<?php

namespace App\Http\Controllers;

use App\Models\GenreLagu;
use Generator;
use Illuminate\Http\Request;

class ControllerGenreLagu extends Controller
{
    public function index()
    {

        $data = new GenreLagu();

        $lagu = GenreLagu::with('lagu')->get();

        return view('html.genre_lagu', [
            'genre' => $lagu,
            'ketegori' => $data->kategori_lomba()
        ]);
    }

    public function store( Request $request){

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255|unique:tbl_lagu',
            'genre' => 'required|string|max:255',
            'kategori' => 'required|integer|max:10',
            
        ]);

        try {
            GenreLagu::create([
                'judul' => ucwords($validatedData['judul']),
                'genre' => ucwords($validatedData['genre']),
                'id_kategori_lomba' => $validatedData['kategori']
            ]);
            return redirect()->route('genre_lagu.index')->with('success', 'Genre lagu berhasil ditambahkan.');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan kategori.']);
        }
        
    }

    public function destroy($id)
    {
        $kategori = GenreLagu::findOrFail($id);
        $kategori->delete();
        return redirect()->route('genre_lagu.index')->with('success', 'Kategori berhasil dihapus.');
    }

}
