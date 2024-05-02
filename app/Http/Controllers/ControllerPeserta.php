<?php

namespace App\Http\Controllers;

use App\Models\DataJemaat;
use App\Models\GenreLagu;
use App\Models\KategoriJemaat;
use App\Models\Peserta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ControllerPeserta extends Controller
{
    public function index(){

        $registers = Peserta::with('data_jemaat', 'data_lagu', 'kategori_lomba')->get();
        return view('html.data_peserta', [
            'peserta' => $registers
        ]);
    }

    public function store_data_register(){


    }

    public function display_data_register(){
        $model = new Peserta();
       
        return response([
            'kategori' => $model->jenis(),
            'lagu'     => $model->lagu(),
            'jemaat'   => $model->jemaat()
        ]);
        
    }

    public function destroy($id)
    {
        $kategori = Peserta::findOrFail($id);
        $kategori->delete();
        return redirect()->route('peserta.index')->with('success', 'Data has been deleted.');
    }
}
