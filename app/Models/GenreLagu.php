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
        'genre'
    ];
}
