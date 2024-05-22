<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class MaxTwoIdJemaat implements ValidationRule
{

    protected $idJemaat;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
    }

    public function __construct($idJemaat)
    {
        $this->idJemaat = $idJemaat;
    }

    public function passes($attribute, $value)
    {
        // Hitung jumlah entri dengan id_jemaat yang sama
        $count = DB::table('tbl_register')
                    ->where('id_njemaat', $this->idJemaat)
                    ->count();

        // Pastikan tidak lebih dari dua
        return $count < 2;
    }

    public function message()
    {
        return 'Id Jemaat tidak boleh lebih dari dua entri yang sama.';
    }
}
