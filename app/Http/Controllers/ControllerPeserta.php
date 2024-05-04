<?php

namespace App\Http\Controllers;

use App\Models\DataJemaat;
use App\Models\GenreLagu;
use App\Models\KategoriJemaat;
use App\Models\Peserta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllerPeserta extends Controller
{
    public function index(){

        $registers = Peserta::with('data_jemaat', 'data_lagu', 'kategori_lomba')->get();
        return view('html.data_peserta', [
            'peserta' => $registers
        ]);
    }

    public function store_data_register(Request $request){
        // $data = json_decode($request->getContent(), true);
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required|integer|max:10',
            'kordinator' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'kategori' => 'required|string|max:255',
            'lagu_wajib' => 'required|string|max:255',
            'lagu_pilihan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // 422 adalah kode status untuk validasi gagal
        }
       

       

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
