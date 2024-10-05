<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Review;
use App\Models\KategoriLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllerReview extends Controller
{
    public function index() {
        return view('html.reviews');
    }


    public function getData() {

        $registers = Peserta::with('data_jemaat:id_njemaat,nama', 'data_lagu:id_lagu,judul,genre', 'kategori_lomba:kategori_lomba,id_kategori_lomba')
                            ->whereNotNull('no_tampil')
                            ->where('no_tampil', '!=', '')
                            ->where('status',1)
                            ->orderBy('id_kategori_lomba') // Mengurutkan berdasarkan kategori lomba
                            ->orderBy('no_tampil') // Mengurutkan berdasarkan nomor tampil dalam setiap kategori
                            ->get(); // Pastikan ini sesuai dengan kebutuhan Anda

        return response()->json($registers);

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

            'intonasi_wajib' => 'required|integer|max:100',
            'vocal_wajib' => 'required|integer|max:100',
            'partitur_wajib' => 'required|integer|max:100',
            'artitistik_wajib' => 'required|integer|max:100',
            
            'intonasi_pilihan' => 'required|integer|max:100',
            'vocal_pilihan' => 'required|integer|max:100',
            'partitur_pilihan' => 'required|integer|max:100',
            'artitistik_pilihan' => 'required|integer|max:100',
        ]);

        $validator->after(function ($validator) use ($request) {
            $exists = Review::where('id_njemaat', $request->id_register)
                                ->where('id_user', $request->id_user)
                                ->where('id_kategori_lomba', $request->id_kategori_lomba)
                                ->exists();
    
            if ($exists) {
                $validator->errors()->add('id_register', 'Anda hanya dapat memberikan satu penilaian untuk peserta ini');
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

         return response()->json(['message' => 'Penilaian Berhasil']);


    }


    public function viewdash(){
        return view('html.dash');
    }

    public function reviews_stop() {
        // Tampilkan data ke dashboard
        $reviews = Review::with('user:name,id_user,level as juri_level,img_src as foto_juri',
        'jemaat:nama,id_njemaat',
        'kategori_lomba:id_kategori_lomba,kategori_lomba')
        ->whereHas('kategori_lomba', function($query) {
            $query->where('status', 1);
        })->get();
    
        $groupedReviews = $reviews->groupBy(['id_kategori_lomba','id_njemaat']);
    
        $groupedReviews = $groupedReviews->map(function ($userReviews) {
            $totalFinal = 0;
            $nilai_akhir = 0;
            $medali = "";
            $juriData = [];
    
            $mappedReviews = $userReviews->map(function ($reviews) use (&$totalFinal, &$juriData) {
                $totalNilaiWajib = $reviews->where('genre_lagu', 'LAGU WAJIB')->sum('nilai');
                $totalNilaiPilihan = $reviews->where('genre_lagu', 'LAGU PILIHAN')->sum('nilai');
                $totalNilai = $totalNilaiWajib + $totalNilaiPilihan;
    
                $totalFinal += $totalNilai;
    
                $juriData = $reviews->map(function ($review) {
                    return [
                        'name' => $review->user->name,
                        'photo_url' => asset('images/profile/' . $review->user->foto_juri)
                    ];
                })->unique('name')->values();
                
                
    
                return [
                    'data' => $reviews,
                    'nilai_keseluruhan' => $totalNilai,
                    'total_nilai' => $totalNilai / 2
                ];
            });
    
            $nilai_akhir = round(($totalFinal / 2) / 3, 2); // Melakukan pembulatan menjadi 2 decimal
    
            if ($nilai_akhir < 60) {
                $medali = "Bronze";
            } else if ($nilai_akhir >= 60 && $nilai_akhir < 80) {
                $medali = "Silver";
            } else if ($nilai_akhir >= 80 && $nilai_akhir <= 100) {
                $medali = "Gold";
            }
    
            return [
                'reviews' => $mappedReviews,
                'medali' => $medali,
                'nomor_tampil' => $mappedReviews->first()['data']->first()->no_tampil,
                'jemaat' => $mappedReviews->first()['data']->first()->jemaat->nama,
                'total_final' => $nilai_akhir,
                'kategori' => $mappedReviews->first()['data']->first()->kategori_lomba->kategori_lomba,
                'juri' => $juriData
            ];
        });
    
        $sortedReviews = $groupedReviews->sortByDesc('total_final');
        return response()->json(['data' => $sortedReviews]);
    }
    

    public function reviews_stop_1() {
        //tampilkan data ke dashboard
        $reviews = Review::with('user:name,id_user,level as juri_level,img_src as foto_juri',
        'jemaat:nama,id_njemaat',
        'kategori_lomba:id_kategori_lomba,kategori_lomba')
        ->whereHas('kategori_lomba', function($query) {
            $query->where('status', 1);
        })->get();

        $groupedReviews = $reviews->groupBy(['kategori_lomba', 'id_njemaat' ,'id_user']);
        
        $groupedReviews = $groupedReviews->map(function ($userReviews) {
        $totalFinal = 0;
        $nilai_akhir = 0;
        $medali = "";
        $juriData = [];
        
        $mappedReviews = $userReviews->map(function ($reviews) use (&$totalFinal, &$juriData) {
        $totalNilaiWajib = $reviews->where('genre_lagu', 'LAGU WAJIB')->sum('nilai');
        $totalNilaiPilihan = $reviews->where('genre_lagu', 'LAGU PILIHAN')->sum('nilai');
        $totalNilai = $totalNilaiWajib + $totalNilaiPilihan;
        
        $totalFinal += $totalNilai;

        $juriData [] = [
            'name' => $reviews->first()->user->name,
            'photo_url' => asset('images/profile/' . $reviews->first()->user->foto_juri)
        ];
    
        return ['data' => $reviews,
                    'nilai_keseluruan' => $totalNilai,
                    'total_nilai' => $totalNilai / 2
                ];
        });
        
        $nilai_akhir =  round( ($totalFinal / 2) / 3, 2);//melakukan pembulatan menjadi 2 decimal

        if ($nilai_akhir < 60) {
            $medali = "Bronze";
        } else if ($nilai_akhir >= 60 && $nilai_akhir < 80) {
            $medali = "Silver";
        } else if ($nilai_akhir >= 80 && $nilai_akhir <= 100) {
            $medali = "Gold";
        } 

        return ['reviews' => $mappedReviews,
                'medali'  => $medali,
                'nomor_tampil' => $mappedReviews->first()['data']->first()->no_tampil,
                'jemaat'  => $mappedReviews->first()['data']->first()->jemaat->nama,
                'total_final' => $nilai_akhir,
                'kategori' => $mappedReviews->first()['data']->first()->kategori_lomba->kategori_lomba,
                'juri'  => $juriData
                
            ];
        });

        $sortedReviews = $groupedReviews->sortByDesc('total_final');
        return response()->json(['data' => $sortedReviews]);
    }
    
    
    public function reviews() {

        //tampilkan data ke dashboard
        // $reviews = Review::with('user:name,id_user,level as juri_level,img_src as foto_juri',
        // 'jemaat:nama,id_njemaat',
        // 'kategori_lomba:id_kategori_lomba,kategori_lomba')->get();

        $reviews = Review::with('user:name,id_user,level as juri_level,img_src as foto_juri',
        'jemaat:nama,id_njemaat',
        'kategori_lomba:id_kategori_lomba,kategori_lomba')
        ->whereHas('kategori_lomba', function($query) {
            $query->where('status', 1);
        })->get();

        //$groupedReviews = $reviews->groupBy(['no_tampil', 'id_user']);
        $groupedReviews = $reviews->groupBy(['no_tampil', 'id_user']);

        //$groupedReviews = $reviews->groupBy('kategori_lomba','id_user');

        
        $groupedReviews = $groupedReviews->map(function ($userReviews) {
        $totalFinal = 0;
        $nilai_akhir = 0;
        $medali = "";
        $juriData = []; //new
        
        $mappedReviews = $userReviews->map(function ($reviews) use (&$totalFinal, &$juriData) {
        $totalNilaiWajib = $reviews->where('genre_lagu', 'LAGU WAJIB')->sum('nilai');
        $totalNilaiPilihan = $reviews->where('genre_lagu', 'LAGU PILIHAN')->sum('nilai');
        $totalNilai = $totalNilaiWajib + $totalNilaiPilihan;
        
        $totalFinal += $totalNilai;

        $juriData [] = [
            'name' => $reviews->first()->user->name,
            'photo_url' => asset('images/profile/' . $reviews->first()->user->foto_juri)
        ];
    
        return ['data' => $reviews,
                    'nilai_keseluruan' => $totalNilai,
                    'total_nilai' => $totalNilai / 2
                ];
        });
        
        $nilai_akhir =  round( ($totalFinal / 2) / 3, 2);//melakukan pembulatan menjadi 2 decimal

        if ($nilai_akhir < 60) {
            $medali = "Bronze";
        } else if ($nilai_akhir >= 60 && $nilai_akhir < 80) {
            $medali = "Silver";
        } else if ($nilai_akhir >= 80 && $nilai_akhir <= 100) {
            $medali = "Gold";
        } 

        return ['reviews' => $mappedReviews,
                'medali'  => $medali,
                'nomor_tampil' => $mappedReviews->first()['data']->first()->no_tampil,
                'jemaat'  => $mappedReviews->first()['data']->first()->jemaat->nama,
                'total_final' => $nilai_akhir,
                'kategori' => $mappedReviews->first()['data']->first()->kategori_lomba->kategori_lomba,
                'juri'  => $juriData
            ];
        });

        $sortedReviews = $groupedReviews->sortByDesc('total_final');
        return response()->json(['data' => $sortedReviews]);
        
    }

    
    public function lihat_Reviews(){
        $reviews = Review::with('user:name,id_user,level as juri_level,img_src as foto_juri',
    'jemaat:nama,id_njemaat',
    'kategori_lomba:id_kategori_lomba,kategori_lomba')->get();

    // Kelompokkan berdasarkan kategori, jemaat, dan user
    $groupedReviews = $reviews->groupBy(['id_kategori_lomba', 'id_njemaat', 'id_user']);

    $groupedReviews = $groupedReviews->map(function ($userReviews) {
        $totalFinal = 0;
        $nilai_akhir = 0;
        $medali = "";

        $mappedReviews = $userReviews->map(function ($reviews) use (&$totalFinal) {
            $totalNilaiWajib = $reviews->where('genre_lagu', 'LAGU WAJIB')->sum('nilai');
            $totalNilaiPilihan = $reviews->where('genre_lagu', 'LAGU PILIHAN')->sum('nilai');
            $totalNilai = $totalNilaiWajib + $totalNilaiPilihan;

            $totalFinal += $totalNilai;

            return [
                'data' => $reviews,
                'nilai_keseluruan' => $totalNilai,
                'total_nilai' => $totalNilai / 2
            ];
        });

        $nilai_akhir = ($totalFinal / 2) / 3;
        $nilai_akhir = number_format($nilai_akhir, 2);
        $nilai_akhir = (float) $nilai_akhir;

        if ($nilai_akhir < 60) {
            $medali = "Bronze";
        } else if ($nilai_akhir >= 60 && $nilai_akhir < 80) {
            $medali = "Silver";
        } else if ($nilai_akhir >= 80 && $nilai_akhir <= 100) {
            $medali = "Gold";
        }

        $firstReview = $mappedReviews->first()['data']->first()->first();

        return [
            'reviews' => $mappedReviews,
            'medali' => $medali,
            'nomor_tampil' => $firstReview ? $firstReview->no_tampil : null,
            'jemaat' => $firstReview ? $firstReview->jemaat->nama : null,
            'total_final' => $nilai_akhir
        ];
    });

    $sortedReviews = $groupedReviews->sortByDesc('total_final');

    return view('html.lihat_review', ['data' => $sortedReviews]);

    }

    public function dash_setting_view(){
        return view('html.dash_setting');
    }

    public function dash_setting_data(){
        $category = KategoriLomba::all();
        return response()->json($category);
    }

    public function dash_setting_updated_stop(Request $request){

    
        $id = $request->input('id');
        $statusValue = $request->input('status') === 'true';

        $peserta = KategoriLomba::where('id_kategori_lomba', $id)->firstOrFail();
        $peserta->status = $statusValue;
        $peserta->save();
        return response()->json(['message' => 'Status updated successfully']);
       
       
    }

    public function dash_setting_updated(Request $request) {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'id' => 'required|integer',
                'status' => 'required|boolean|unique:status'
            ]);
    
            // Ambil data dari input yang sudah divalidasi
            $id = $validatedData['id'];
            $statusValue = $validatedData['status'];
    
            // Update status peserta
            $peserta = KategoriLomba::where('id_kategori_lomba', $id)->firstOrFail();
            $peserta->status = $statusValue;
            $peserta->save();

            return response()->json(['message' => 'Status updated successfully']);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangkap pengecualian validasi dan kembalikan pesan error dalam format JSON
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
    
    
    
}
