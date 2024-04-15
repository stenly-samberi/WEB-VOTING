<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLomba extends Model
{
    use HasFactory;

    protected $table = 'tbl_kategori_lomba';

    protected $primaryKey = 'id_kategori_lomba';

    protected $fillable = [
        'kategori_lomba',
    ];

}
