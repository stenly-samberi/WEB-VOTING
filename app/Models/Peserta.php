<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peserta extends Model
{
    use HasFactory;

    protected $table = 'tbl_register';
    protected $primaryKey = 'id_register';
    protected $guarded = [];

    public function data_jemaat()
    {
        return $this->belongsTo(DataJemaat::class, 'id_njemaat','id_njemaat');
    }

    public function data_lagu()
    {
        return $this->belongsTo(GenreLagu::class, 'id_lagu','id_lagu');
    }

    public function kategori_lomba()
    {
        return $this->belongsTo(KategoriLomba::class, 'id_kategori_lomba','id_kategori_lomba');
    }
}
