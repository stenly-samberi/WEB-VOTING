<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreLagu extends Model
{
    use HasFactory;

    protected $table = 'tbl_lagu';

    protected $primaryKey = 'id_lagu';

    protected $fillable = [
        'judul',
        'genre',
        'id_kategori_lomba'
    ];

   

    public function kategori_lomba(){
        return KategoriLomba::SELECT('id_kategori_lomba', 'kategori_lomba as jenis_lomba')->get();
    }

    // public function lagu(){
    //     return GenreLagu::SELECT('id_lagu','id_kategori_lomba','judul','genre','created_at','updated_at')->get();
    // }

    public function lagu()
    {
        return $this->belongsTo(KategoriLomba::class, 'id_kategori_lomba','id_kategori_lomba');
    }

}
