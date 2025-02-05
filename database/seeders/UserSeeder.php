<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Bintang',
            'email' => 'bintang@example.com',
            'password' => Hash::make('Rahasia123..'),
            'no_telf' => '082137761288',
            'alamat' => 'Cemani, Grogol, Sukoharjo'
        ]);

        DB::table('users')->insert([
            'name' => 'Denta',
            'email' => 'denta@example.com',
            'password' => Hash::make('hilang'),
            'no_telf' => '0812341234',
            'alamat' => 'Yogyakarta'
        ]);
    }
}
