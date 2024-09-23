<?php

namespace App\Http\Controllers;
use App\Rules\MaxTwoIdJemaat;
use App\Rules\MaxTwoPhone;
use App\Models\DataJemaat;
use App\Models\GenreLagu;
use App\Models\KategoriJemaat;
use App\Models\Peserta;
use App\Rules\MaxKategoryByJemaat;
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
      
        try {
            // Validasi data
            $validator = Validator::make($request->all(), [
                'id_njemaat'  => ['required','integer', 'max:255', new MaxTwoIdJemaat($request->id_njemaat)],
                'kordinator'  => ['required','string','max:255','unique:tbl_register'],
                'phone'       => ['required', 'unique:tbl_register', 'min:10', 'max:12'],
                'kategori'    => ['required', 'integer', 'max:255', new MaxKategoryByJemaat($request->id_njemaat, $request->kategori)],
                'laguWajib'   => 'required|string|max:255',
                'laguPilihan' => 'required|integer|max:255'
            ], [
                'phone.unique'      => 'Nomor telepon sudah terdaftar.',
                'phone.min'         => 'Nomor telepon harus memiliki minimal 10 karakter.',
                'phone.max'         => 'Nomor telepon harus memiliki maksimal 12 karakter.',
                'kordinator.unique' => 'Nama Kordinator sudah terdaftar.'
            ]);
    
            // Jika validasi gagal
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); // 422 adalah kode status untuk validasi gagal
            }

            // Validasi berhasil, simpan data
            Peserta::create([
                'id_njemaat'         => $request->id_njemaat,
                'id_lagu'            => $request->laguPilihan,
                'lagu_wajib'         => $request->laguWajib,
                'id_kategori_lomba'  => $request->kategori,
                'kordinator'         => $request->kordinator,
                'phone'              => $request->phone,
                'status'             => 0,
                'file'               => 'empty.pdf',
            ]);

            // Berikan respons sukses
            // return response()->json('Pendaftaran Peserta Berhasil', 200);
            
            return response()->json(['message' => 'Pendaftaran Peserta Berhasil'], 200);
           
        

        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json('Terjadi Kesalahan : ' . $e->getMessage(), 500);
        }
        return redirect()->route('peserta.index')->with('success', 'Pendaftaran Peserta Berhasil');
    }

    public function display_data_register(){
        $model = new Peserta();
       
        return response([
            'kategori' => $model->jenis(),
            'lagu'     => $model->lagu(),
            'jemaat'   => $model->jemaat()
        ]);
        
    }

    public function peserta_detail(Request $request){
        $model = new Peserta();
        //return $model->detail_peserta($request->idP);
        return view('html.detail_peserta', [
            'peserta' => $model->detail_peserta($request->idP)
        ]);
    }

    public function destroy($id)
    {
        $kategori = Peserta::findOrFail($id);
        $kategori->delete();
        return redirect()->route('peserta.index')->with('success', 'Data has been deleted.');
    }

    public function updated(Request $request, $id){
     
            $request->validate([
                'nomor_tampil' => 'required|integer|min:2',
            ]);

            // Temukan peserta berdasarkan ID
            $peserta = Peserta::findOrFail($id);

            // Update nomor tampil
            $peserta->no_tampil = $request->input('nomor_tampil');
            $peserta->save();

            // Redirect atau response sesuai kebutuhan
            return redirect()->route('peserta.index')->with('success', 'Nomor tampil berhasil diupdate');
            }
}
