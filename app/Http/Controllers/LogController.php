<?php

namespace App\Http\Controllers;
use App\Models\KategoriLomba;
use App\Models\DataJemaat;
use App\Models\Review;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LogController extends Controller
{
    
    public function jemaat(){
        $jemaat = DataJemaat::all();
        return response()->json(['data' => $jemaat]);
    }

    public function kategori(){
        $kategori = KategoriLomba::all();
        return response()->json(['data' => $kategori]);
    }

    public function data_logs(Request $request) {
        $reviews = Review::with([
            'user' => function($query) {
                $query->select('name', 'id_user', 'level', 'img_src');
            },
            'jemaat' => function($query) {
                $query->select('nama', 'id_njemaat');
            },
            'kategori_lomba' => function($query) {
                $query->select('id_kategori_lomba', 'kategori_lomba');
            }
        ])
        ->where('id_kategori_lomba', $request->kategori)
        ->where('id_njemaat', $request->jemaat)
        ->get();
        
        $groupedReviews = $reviews->groupBy(['no_tampil', 'id_user']);

        $groupedReviews = $groupedReviews->map(function ($userReviews) {
        $totalLagu = 0;
        $nilai_akhir = 0;
        $medali = "";
        $juriData = []; //new
        
        $mappedReviews = $userReviews->map(function ($reviews) use (&$totalLagu, &$juriData) {
        $totalNilaiWajib = $reviews->where('genre_lagu', 'LAGU WAJIB')->sum('nilai');
        $totalNilaiPilihan = $reviews->where('genre_lagu', 'LAGU PILIHAN')->sum('nilai');
        $totalNilai = $totalNilaiWajib + $totalNilaiPilihan;
        
        $totalLagu += $totalNilai;

        $juriData [] = [
            'name' => $reviews->first()->user->name,
            'photo_url' => asset('images/profile/' . $reviews->first()->user->foto_juri)
        ];
    
        return ['data' => $reviews,
                    'nilai_keseluruan' => $totalNilai,
                    'total_nilai' => $totalNilai / 2
                ];
        });
        
        $nilai_akhir =  round( ($totalLagu / 2) / 3, 2);//melakukan pembulatan menjadi 2 decimal

        if ($nilai_akhir < 60) {
            $medali = "Bronze";
        } else if ($nilai_akhir >= 60 && $nilai_akhir < 80) {
            $medali = "Silver";
        } else if ($nilai_akhir >= 80 && $nilai_akhir <= 100) {
            $medali = "Gold";
        } 

        return ['reviews' => $mappedReviews,
                'medali'  => $medali,
                'peserta'  => $mappedReviews->first()['data']->first()->jemaat->nama,
                'nomor_tampil' => $mappedReviews->first()['data']->first()->no_tampil,
                'jemaat'  => $mappedReviews->first()['data']->first()->jemaat->nama,
                'total_final' => $nilai_akhir,
                'kategori' => $mappedReviews->first()['data']->first()->kategori_lomba->kategori_lomba,
                'juri'  => $juriData
            ];
        });

        $sortedReviews = $groupedReviews->sortByDesc('total_final');

        return view('html.lihat_review', [
            'data_logs' => $sortedReviews
        ]);
    }

    public function downloadPDF()
    {
        $data_logs = // Ambil data log Anda di sini
        $pdf = Pdf::loadView('pdf.log', compact('data_logs'));
        return $pdf->download('data_log.pdf');
    }

}
