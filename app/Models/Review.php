<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Register;
use App\Models\User;
use App\Models\DataJemaat;
use App\Models\KategoriLomba;
use App\Models\Peserta;

class Review extends Model
{
    use HasFactory;

    protected $table = 'tbl_penilaian';

    protected $primaryKey = 'id_penilaian';

    protected $fillable = [
            'id_register',
            'id_user',
            'id_kategori_lomba',
            'judul_lagu',
            'genre_lagu',
            'intonasi',
            'vocal',
            'partitur',
            'artitistik',
            'nilai'
    ];

    // public function register()
    // {
    //     return $this->belongsTo(Peserta::class, 'id_register');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jemaat(){
        return $this->belongsTo(DataJemaat::class, 'id_njemaat');
    }

    public function kategori_lomba(){
        return $this->belongsTo(KategoriLomba::class,'id_kategori_lomba');
    }

    public function peserta(){
        return $this->belongsTo(Peserta::class,'id_register');
    }

    
}
