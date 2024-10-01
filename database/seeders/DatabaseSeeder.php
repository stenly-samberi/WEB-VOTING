<?php

namespace Database\Seeders;

use App\Models\DataJemaat;
use App\Models\GenreLagu;
use App\Models\KategoriJemaat;
use App\Models\KategoriLomba;
use App\Models\User;
use App\Models\Users;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      
        User::factory()->create([
            'username' =>'admin',
            'name' => 'Super User',
            'role' => 'admin',
            'level' => 20,
            'password' => 'admin',
            'img_src' => "https://icons.veryicon.com/png/o/internet--web/prejudice/user-128.png"
        ]);

        $kategoriLomba = ['PAR','PAM'];
        foreach ($kategoriLomba as $key) {
            KategoriLomba::create([
                'kategori_lomba' => $key,
                'status' => false
            ]);
        }

         $GenreLagu = [
            ['id_kategori_lomba' => 1, 'judul' => 'MARS GKI DITANAH PAPUA','genre'=>'Wajib'],
            ['id_kategori_lomba' => 1, 'judul' => 'TING-TING-TING','genre'=>'Pilihan'],
            ['id_kategori_lomba' => 1, 'judul' => 'PRAHU KITA TERSEDIA','genre'=>'Pilihan'], 
            ['id_kategori_lomba' => 1, 'judul' => 'SIARKAN KE BENUA','genre'=>'Pilihan'], 
            ['id_kategori_lomba' => 2, 'judul' => 'HYMNE GKI DITANAH PAPUA','genre'=>'Wajib'],
            ['id_kategori_lomba' => 2, 'judul' => 'TAK SATUPUN','genre'=>'Pilihan'],
            ['id_kategori_lomba' => 2, 'judul' => 'CINTAILAH SESAMAMU','genre'=>'Pilihan'], 
            ['id_kategori_lomba' => 2, 'judul' => 'KEMBARA DUNIA','genre'=>'Pilihan'], 
            ['id_kategori_lomba' => 2, 'judul' => 'FAJAR MEREKAH','genre'=>'Pilihan'], 
        ];

        foreach ($GenreLagu as $i) {
            GenreLagu::create([
                'judul' => $i['judul'],
                'genre' => $i['genre'],
                'id_kategori_lomba' => $i['id_kategori_lomba']
            ]);
        }

       
        $kategoriJemaat = ['Industri', 'Kotawi', 'Pesisir', 'Trans'];
        foreach ($kategoriJemaat as $key) {
            KategoriJemaat::create([
                'kategori' => $key,
            ]);
        }

        $dataJemaat = [
            ['id_kjemaat' => 1, 'nama' => 'GKI BETLEHEM – KUALA KENCANA'],
            ['id_kjemaat' => 1, 'nama' => 'GKI GETSEMANI – MILE 38/39'],
            ['id_kjemaat' => 1, 'nama' => 'GKI KALVARI - TEMBAGAPURA'],
            ['id_kjemaat' => 1, 'nama' => 'GKI VIADOLOROSA - RIDGE CAMP'],
            ['id_kjemaat' => 2, 'nama' => 'GKI DIASPORA - SP2'],
            ['id_kjemaat' => 2, 'nama' => 'GKI EBENHAEZER TIMIKA'],
            ['id_kjemaat' => 2, 'nama' => 'GKI EFRATA TIMIKA'],
            ['id_kjemaat' => 2, 'nama' => 'GKI ELIM – WANAGON SP2'],
            ['id_kjemaat' => 2, 'nama' => 'GKI GALILEA TIMIKA'],
            ['id_kjemaat' => 2, 'nama' => 'GKI IMANUEL – TIMIKA'],
            ['id_kjemaat' => 2, 'nama' => 'GKI KANAAN – TIMIKA'],
            ['id_kjemaat' => 2, 'nama' => 'GKI KASIH - AMAMAPARE TIMIKA INDAH'],
            ['id_kjemaat' => 2, 'nama' => 'GKI MARANATHA KARANG SENANG'],
            ['id_kjemaat' => 2, 'nama' => 'GKI MARTEN LUTHER TIMIKA'],
            ['id_kjemaat' => 2, 'nama' => 'GKI MORIA TIMIKA'],
            ['id_kjemaat' => 2, 'nama' => 'GKI PAULUS TIMIKA'],
            ['id_kjemaat' => 2, 'nama' => 'GKI PENGHARAPAN AMOR'],
            ['id_kjemaat' => 2, 'nama' => 'GKI PNIEL - TIMIKA'],
            ['id_kjemaat' => 2, 'nama' => 'GKI SOLA GRATIA - NAWARIPI'],
            ['id_kjemaat' => 2, 'nama' => 'GKI SYALOOM AMUNGSA'],
            ['id_kjemaat' => 2, 'nama' => 'GKI VIADOLOROSA SEMPAN'],
            ['id_kjemaat' => 3, 'nama' => 'GKI BETHEL KAPIRAYA'],
            ['id_kjemaat' => 3, 'nama' => 'GKI EFATA – UTA'],
            ['id_kjemaat' => 3, 'nama' => 'GKI GIDEON – KILIARMA AKIMUGA'],
            ['id_kjemaat' => 3, 'nama' => 'GKI IMANUEL – KOKONAO'],
            ['id_kjemaat' => 3, 'nama' => 'JEMAAT PERSIAPAN KAIROS POUMAKO'],
            ['id_kjemaat' => 4, 'nama' => 'EIRENE BINTUKA SP13'],
            ['id_kjemaat' => 4, 'nama' => 'GKI EKLESIA – LIMAU ASRI SP5'],
            ['id_kjemaat' => 4, 'nama' => 'GKI EL ROI – WONOSARI JAYA SP4'],
            ['id_kjemaat' => 4, 'nama' => 'GKI GENESARET KAMORO INDAH TIMIKA'],
            ['id_kjemaat' => 4, 'nama' => 'GKI KASIH – POUMAKO'],
            ['id_kjemaat' => 4, 'nama' => 'GKI KORNELIUS - BRIGIF KM 14 MAPURU JAYA'],
            ['id_kjemaat' => 4, 'nama' => 'GKI LAHAI ROI – SP1'],
            ['id_kjemaat' => 4, 'nama' => 'GKI OTTOW GEISSLER – MILE 32'],
            ['id_kjemaat' => 4, 'nama' => 'GKI PROVIDENSIA – KWAMKI NARAMA'],
            ['id_kjemaat' => 4, 'nama' => 'GKI REHOBOT – MULIA KENCANA SP7'],
            ['id_kjemaat' => 4, 'nama' => 'GKI SOLAFIDE – MAPURU JAYA'],
            ['id_kjemaat' => 4, 'nama' => 'JEMAAT PERSIAPAN BUKIT ZAITUN']
        ];

       
        foreach ($dataJemaat as $jemaat) {
            DataJemaat::create([
                'id_kjemaat' => $jemaat['id_kjemaat'],
                'nama' => $jemaat['nama']
            ]);
        }

        
    

    }
}
