<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1, 
                'penjualan_kode' => 'PJL001',
                'pembeli' => 'John Doe',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 2, 
                'penjualan_kode' => 'PJL002',
                'pembeli' => 'Jane Smith',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 3, 
                'penjualan_kode' => 'PJL003',
                'pembeli' => 'Alice Johnson',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 1, 
                'penjualan_kode' => 'PJL004',
                'pembeli' => 'Bob Williams',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 2, 
                'penjualan_kode' => 'PJL005',
                'pembeli' => 'Eva Brown',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 3, 
                'penjualan_kode' => 'PJL006',
                'pembeli' => 'David Davis',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 1, 
                'penjualan_kode' => 'PJL007',
                'pembeli' => 'Grace Garcia',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 2, 
                'penjualan_kode' => 'PJL008',
                'pembeli' => 'Henry Harris',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 3, 
                'penjualan_kode' => 'PJL009',
                'pembeli' => 'Ivy Ingram',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 1, 
                'penjualan_kode' => 'PJL010',
                'pembeli' => 'Jack Jackson',
                'penjualan_tanggal' => Carbon::now(),
            ],
        ];
        
        DB::table('t_penjualan')->insert($data);
    }
}
