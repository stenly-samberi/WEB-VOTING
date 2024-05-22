<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MaxTwoPhone implements Rule
{
    protected $phone;

    public function __construct($idJemaat)
    {
        $this->phone = $idJemaat;
    }

    public function passes($attribute, $value)
    {
        // Hitung jumlah entri dengan phone yang sama
        $count = DB::table('tbl_register')
                    ->where('phone', $this->phone)
                    ->count();

        Log::info("Count for phone {$this->phone}: {$count}");

        // Pastikan tidak lebih dari dua
        return $count < 2;
    }

    public function message()
    {
        return 'Phone kordinator sudah terdaftar lebih dari 2 kali.';
    }
}
