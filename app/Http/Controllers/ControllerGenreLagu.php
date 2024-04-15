<?php

namespace App\Http\Controllers;

use App\Models\GenreLagu;
use Illuminate\Http\Request;

class ControllerGenreLagu extends Controller
{
    public function index()
    {
        // $genre = GenreLagu::paginate(5);
        $genre = GenreLagu::all();

        // return $genre;
        return view('html.genre_lagu', [
            'genre' => $genre
        ]);
    }

    public function store( Request $request){

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:255'
        ]);

        try {
            GenreLagu::create([
                'judul' => ucwords($validatedData['judul']),
                'genre' => ucwords($validatedData['genre'])
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
