<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            'nama_menu' => 'Arem-Arem',
            'deskripsi' => 'Arem-arem adalah makanan tradisional Indonesia yang mirip lemper. Terbuat dari nasi yang diisi dengan lauk seperti ayam, daging, atau sayuran, lalu dibungkus daun pisang dan dikukus. Lezat dan praktis untuk dinikmati kapan saja!',
            'gambar' => ('https://asdfasdf.img'),
            'kategori' => 'snack',
            'harga' => intval('3000'),
        ]);

        DB::table('menus')->insert([
            'nama_menu' => 'Nasi Kuning',
            'deskripsi' => 'Nasi Kuning adalah hidangan tradisional Indonesia yang dibuat dari beras yang dimasak dengan santan dan kunyit, sehingga berwarna kuning cerah. Biasanya disajikan dengan aneka lauk seperti ayam goreng, telur, perkedel, dan sambal. Rasanya gurih dan aromanya khas, sering dinikmati pada acara-acara spesial.',
            'gambar' => ('https://awega3faf.img'),
            'kategori' => 'masakan',
            'harga' => intval('13000'),
        ]);
    }
}
