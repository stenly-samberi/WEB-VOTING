<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MaxTwoIdJemaat implements Rule
{
    protected $idJemaat;

    public function __construct($idJemaat)
    {
        $this->idJemaat = $idJemaat;
    }

    public function passes($attribute, $value)
    {
        // Hitung jumlah entri dengan id_njemaat yang sama
        $count = DB::table('tbl_register')
                    ->where('id_njemaat', $this->idJemaat)
                    ->count();

        Log::info("Count for id_njemaat {$this->idJemaat}: {$count}");

        // Pastikan tidak lebih dari dua
        return $count < 2;
    }

    public function message()
    {
        return 'Setiap Jemaat hanya dapat mendaftarkan 2 Kategori yang di lombahkan.';
    }
}
