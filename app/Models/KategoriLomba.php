<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class KategoriLomba extends Model
{
    use HasFactory;

    protected $table = 'tbl_kategori_lomba';

    protected $primaryKey = 'id_kategori_lomba';

    protected $fillable = [
        'kategori_lomba',
        'status'	
    ];

    public function review()
    {
        return $this->hasOne(Review::class);
    }

}
