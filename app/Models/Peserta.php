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

    protected $fillable = [
        'id_njemaat',
        'id_lagu',
        'lagu_wajib',
        'no_tampil',
        'id_kategori_lomba',
        'kordinator',
        'phone',
        'status',
        'file'
    ];



    public function data_jemaat(){
        return $this->belongsTo(DataJemaat::class, 'id_njemaat','id_njemaat');
    }

    public function data_lagu(){
        return $this->belongsTo(GenreLagu::class, 'id_lagu','id_lagu');
    }

    public function kategori_lomba(){
        return $this->belongsTo(KategoriLomba::class, 'id_kategori_lomba','id_kategori_lomba');
    }

    #menampilkan data dari tabel

    public function jenis(){
        return KategoriLomba::SELECT('id_kategori_lomba as idk','kategori_lomba as kategori')->get();
    }

    public function lagu(){
        return GenreLagu::join('tbl_kategori_lomba', 'tbl_kategori_lomba.id_kategori_lomba', '=', 'tbl_lagu.id_kategori_lomba')
                    ->select('tbl_lagu.id_lagu as idl','tbl_kategori_lomba.id_kategori_lomba as idk','tbl_lagu.judul', 'tbl_lagu.genre','tbl_kategori_lomba.kategori_lomba')
                    ->get();
    }

    public function jemaat(){
        return DataJemaat::SELECT('id_njemaat as idj','nama')->get();
    }

    public function detail_peserta($id){
        return Peserta::join('tbl_lagu', 'tbl_lagu.id_lagu', '=', 'tbl_register.id_lagu')
                    ->join('tbl_kategori_lomba', 'tbl_kategori_lomba.id_kategori_lomba', '=', 'tbl_register.id_kategori_lomba')
                    ->join('tbl_njemaat', 'tbl_njemaat.id_njemaat', '=', 'tbl_register.id_njemaat')
                    ->select('tbl_register.id_register as idr','tbl_register.lagu_wajib','tbl_register.no_tampil', 'tbl_lagu.genre as jenis_lagu','tbl_njemaat.nama as nama_jemaat', 
                    'tbl_lagu.judul as judul_lagu', 'tbl_kategori_lomba.kategori_lomba','tbl_register.kordinator','tbl_register.phone',
                    'tbl_register.status','tbl_register.file','tbl_register.created_at','tbl_register.updated_at')
                    ->where('tbl_register.id_register', $id)
                    ->get();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_penilaian');
    }

    
    

    
}
