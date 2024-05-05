<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJemaat extends Model
{
    use HasFactory;

   
    
    protected $table = 'tbl_njemaat';

    protected $primaryKey = 'id_njemaat';

    protected $fillable = [
        'nama',
        'id_kjemaat'
    ];

    public function kategori_jemaat()
    {
        return $this->belongsTo(KategoriJemaat::class, 'id_kjemaat', 'id_kjemaat');
    }

    // public function data_jemaat(){
    //     return DataJemaat::find($id);
    // }

   

}
