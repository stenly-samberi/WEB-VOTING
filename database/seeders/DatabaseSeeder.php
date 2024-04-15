<?php

namespace Database\Seeders;

use App\Models\KategoriJemaat;
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
            'name' => 'admin',
            'role' => 'admin',
            'password' => 'admin@grup',
            'img_src' => "https://icons.veryicon.com/png/o/internet--web/prejudice/user-128.png"
        ]);


        $kategoriJemaat = ['Industri', 'Kotawi', 'Pesisir', 'Trans'];
        foreach ($kategoriJemaat as $key) {
            KategoriJemaat::create([
                'kategori' => $key,
            ]);
        }

        

    }
}
