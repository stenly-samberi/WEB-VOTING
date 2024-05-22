<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MaxKategoryByJemaat implements Rule
{
    protected $idJemaat;
    protected $idKategory;

    public function __construct($idJemaat, $idKategory)
    {
        $this->idJemaat = $idJemaat;
        $this->idKategory = $idKategory;
    }

    public function passes($attribute, $value)
    {
        // Hitung jumlah entri dengan id_jemaat dan id_kategory yang sama
        $count = DB::table('tbl_register')
                    ->where('id_njemaat', $this->idJemaat)
                    ->where('id_kategori_lomba', $this->idKategory)
                    ->count();

        Log::info("Count for id_njemaat {$this->idJemaat} and id_kategori_lomba {$this->idKategory}: {$count}");

        // Pastikan tidak ada entri yang sama
        return $count === 0;
    }

    public function message()
    {
        return 'Nama Jemaat & Kategori Lomba sudah terdaftar.';
    }
}
