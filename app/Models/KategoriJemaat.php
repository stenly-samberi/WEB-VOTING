<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriJemaat extends Model
{
    use HasFactory;
    

    protected $table = 'tbl_kjemaat';

    protected $primaryKey = 'id_kjemaat';

    protected $fillable = [
        'kategori',
    ];

    public function data_jemaat()
    {
        return $this->hasOne(DataJemaat::class);
    }
}
