<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_kode' => 'BEV', 'kategori_nama' => 'Minuman'],
            ['kategori_kode' => 'FOD', 'kategori_nama' => 'Makanan'],
            ['kategori_kode' => 'HMC', 'kategori_nama' => 'Alat Rumah Tangga'],
            ['kategori_kode' => 'CLTH', 'kategori_nama' => 'Pakaian'],
            ['kategori_kode' => 'FASH', 'kategori_nama' => 'Fashion dan Aksesoris'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
