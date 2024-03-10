<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $data = [
            [
                'kategori_id' => 1,
                'barang_kode' => 'BEV001',
                'barang_nama' => 'Air Mineral',
                'harga_beli' => 5000,
                'harga_jual' => 7000,
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'FOD001',
                'barang_nama' => 'Nasi Goreng',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'HMC001',
                'barang_nama' => 'Sendok Stainless',
                'harga_beli' => 2000,
                'harga_jual' => 3000,
            ],
            [
                'kategori_id' => 4,
                'barang_kode' => 'CLTH001',
                'barang_nama' => 'Kemeja Casual',
                'harga_beli' => 50000,
                'harga_jual' => 75000,
            ],
            [
                'kategori_id' => 5,
                'barang_kode' => 'FASH001',
                'barang_nama' => 'Gelang Fashion',
                'harga_beli' => 8000,
                'harga_jual' => 12000,
            ],
            // Penambahan 5 data barang
            [
                'kategori_id' => 1,
                'barang_kode' => 'BEV002',
                'barang_nama' => 'Cola',
                'harga_beli' => 7000,
                'harga_jual' => 10000,
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'FOD002',
                'barang_nama' => 'Pizza',
                'harga_beli' => 15000,
                'harga_jual' => 20000,
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'HMC002',
                'barang_nama' => 'Panci Aluminium',
                'harga_beli' => 30000,
                'harga_jual' => 40000,
            ],
            [
                'kategori_id' => 4,
                'barang_kode' => 'CLTH002',
                'barang_nama' => 'Celana Jeans',
                'harga_beli' => 60000,
                'harga_jual' => 90000,
            ],
            [
                'kategori_id' => 5,
                'barang_kode' => 'FASH002',
                'barang_nama' => 'Topi Snapback',
                'harga_beli' => 12000,
                'harga_jual' => 18000,
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
