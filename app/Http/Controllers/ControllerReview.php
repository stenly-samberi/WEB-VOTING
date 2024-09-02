<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllerReview extends Controller
{
    public function index() {
        $registers = Peserta::with('data_jemaat:id_njemaat,nama', 'data_lagu:id_lagu,judul,genre', 'kategori_lomba:kategori_lomba,id_kategori_lomba')
                            ->whereNotNull('no_tampil')
                            ->where('no_tampil', '!=', '')
                            ->get()
                            ->sortByDesc('no_tampil');
                            //return $registers;

                            
        return view('html.reviews', [
            'peserta' => $registers
        ]);
    }

    

    public function hitung(Request $request) {
     
        $validator = Validator::make($request->all(), [
            'id_register' => 'required',
            'id_user' => 'required',
            'id_kategori_lomba' => 'required',

            'no_tampil' => 'required',

            'title_lagu_wajib' => 'required',
            'title_lagu_pilihan'   => 'required',

            'lagu_wajib_value' => 'required',
            'lagu_pilihan_value' => 'required',

            'intonasi_wajib' => 'required|numeric|max:100',
            'vocal_wajib' => 'required|numeric|max:100',
            'partitur_wajib' => 'required|numeric|max:100',
            'artitistik_wajib' => 'required|numeric|max:100',
            
            'intonasi_pilihan' => 'required|numeric|max:100',
            'vocal_pilihan' => 'required|numeric|max:100',
            'partitur_pilihan' => 'required|numeric|max:100',
            'artitistik_pilihan' => 'required|numeric|max:100',
        ]);

        $validator->after(function ($validator) use ($request) {
            $exists = Review::where('id_njemaat', $request->id_register)
                                ->where('id_user', $request->id_user)
                                ->exists();
    
            if ($exists) {
                $validator->errors()->add('id_register', 'User sudah menginput parameter untuk id_register ini.');
            }
        });

       
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

    

        $laguData = [
            [
                'title' => $request->title_lagu_wajib,
                'value' => $request->lagu_wajib_value,
                'intonasi' => $request->intonasi_wajib,
                'vocal' => $request->vocal_wajib,
                'partitur' => $request->partitur_wajib,
                'artitistik' => $request->artitistik_wajib,
            ],
            [
                'title' => $request->title_lagu_pilihan,
                'value' => $request->lagu_pilihan_value,
                'intonasi' => $request->intonasi_pilihan,
                'vocal' => $request->vocal_pilihan,
                'partitur' => $request->partitur_pilihan,
                'artitistik' => $request->artitistik_pilihan,
            ]
        ];


        foreach ($laguData as $data) {

            $nilai = ($data['intonasi'] + $data['vocal'] + $data['partitur'] + $data['artitistik']) / 4;

            $lagu = new Review();
            $lagu->id_njemaat = $request->id_register;
            $lagu->id_user = $request->id_user;
            $lagu->id_kategori_lomba = $request->id_kategori_lomba;
            $lagu->no_tampil = $request->no_tampil;
            $lagu->genre_lagu = $data['title'];
            $lagu->judul_lagu = $data['value'];
            $lagu->intonasi = $data['intonasi'];
            $lagu->vocal = $data['vocal'];
            $lagu->partitur = $data['partitur'];
            $lagu->artitistik = $data['artitistik'];
            $lagu->nilai = $nilai;
            $lagu->save();
        }

        return response()->json(['message' => 'Penilaian berhasil disimpan!']);


    }

    public function reviews() {
        //tampilkan data ke dashboard
        $reviews = Review::with('user:name,id_user,level as juri_level','jemaat:nama,id_njemaat','kategori_lomba:id_kategori_lomba,kategori_lomba')->get();
        
        $groupedReviews = $reviews->groupBy(['no_tampil', 'id_user']);
        
        $groupedReviews = $groupedReviews->map(function ($userReviews) {
        $totalFinal = 0;
        $nilai_akhir = 0;
        $medali = "";
        
        $mappedReviews = $userReviews->map(function ($reviews) use (&$totalFinal) {
        $totalNilaiWajib = $reviews->where('genre_lagu', 'LAGU WAJIB')->sum('nilai');
        $totalNilaiPilihan = $reviews->where('genre_lagu', 'LAGU PILIHAN')->sum('nilai');
        $totalNilai = $totalNilaiWajib + $totalNilaiPilihan;
        
        $totalFinal += $totalNilai;
    
        return ['data' => $reviews,
                    'nilai_keseluruan' => $totalNilai,
                    'total_nilai' => $totalNilai / 2];
        });
        
        $nilai_akhir =  round( ($totalFinal / 2) / 3, 2); //melakukan pembulatan menjadi 2 decimal

        if ($nilai_akhir >= 60 && $nilai_akhir <= 75) {
            $medali = "Bronze";
        } else if ($nilai_akhir >= 76 && $nilai_akhir <= 85) {
            $medali = "Silver";
        } else if ($nilai_akhir >= 86 && $nilai_akhir <= 100) {
            $medali = "Gold";
        } else {
            $medali = "Tidak ada medali";
        }

        return ['reviews' => $mappedReviews,
                'medali'  => $medali,
                'nomor_tampil' => $mappedReviews->first()['data']->first()->no_tampil,
                'jemaat'  => $mappedReviews->first()['data']->first()->jemaat->nama,
                'total_final' => ($totalFinal/2)/3];
        });

        $sortedReviews = $groupedReviews->sortByDesc('total_final');

        //return $sortedReviews;

        return view('html.dash', ['data' => $sortedReviews]);
        
    }

    
    public function lihat_Reviews(){

        $reviews = Review::with('user:name,id_user,level as juri_level','jemaat:nama,id_njemaat','kategori_lomba:id_kategori_lomba,kategori_lomba')->get();
        
        $groupedReviews = $reviews->groupBy(['no_tampil', 'id_user']);
        
        $groupedReviews = $groupedReviews->map(function ($userReviews) {
        $totalFinal = 0;
        $nilai_akhir = 0;
        $medali = "";
        
        $mappedReviews = $userReviews->map(function ($reviews) use (&$totalFinal) {
        $totalNilaiWajib = $reviews->where('genre_lagu', 'LAGU WAJIB')->sum('nilai');
        $totalNilaiPilihan = $reviews->where('genre_lagu', 'LAGU PILIHAN')->sum('nilai');
        $totalNilai = $totalNilaiWajib + $totalNilaiPilihan;
        
        $totalFinal += $totalNilai;
    
        return ['data' => $reviews,
                    'nilai_keseluruan' => $totalNilai,
                    'total_nilai' => $totalNilai / 2];
        });
        
        $nilai_akhir = ($totalFinal / 2) / 3;

        if ($nilai_akhir >= 60 && $nilai_akhir <= 75) {
            $medali = "Bronze";
        } else if ($nilai_akhir >= 76 && $nilai_akhir <= 85) {
            $medali = "Silver";
        } else if ($nilai_akhir >= 86 && $nilai_akhir <= 100) {
            $medali = "Gold";
        } else {
            $medali = "Tidak ada medali";
        }

        return ['reviews' => $mappedReviews,
                'medali'  => $medali,
                'nomor_tampil' => $mappedReviews->first()['data']->first()->no_tampil,
                'jemaat'  => $mappedReviews->first()['data']->first()->jemaat->nama,
                'total_final' => ($totalFinal/2)/3];
        });

        $sortedReviews = $groupedReviews->sortByDesc('total_final');

        return view('html.lihat_review', ['data' => $sortedReviews]);
       
    }
}
