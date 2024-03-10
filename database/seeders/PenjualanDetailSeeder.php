<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penjualanIds = DB::table('t_penjualan')->pluck('penjualan_id');

        $data = [];

        for ($i=0; $i < 2; $i++) { 
            foreach ($penjualanIds as $penjualanId) {
                $barangIds = DB::table('m_barang')->pluck('barang_id')->random(3);
    
                foreach ($barangIds as $barangId) {
                    $hargaJual = DB::table('m_barang')->where('barang_id', $barangId)->value('harga_jual');
                    $jumlah = rand(1, 10);
    
                    $data[] = [
                        'barang_id' => $barangId,
                        'penjualan_id' => $penjualanId,
                        'harga' => $hargaJual * $jumlah,
                        'jumlah' => $jumlah,
                    ];
                }
            }
        }

        // Insert data into the 't_penjualan_detail' table
        DB::table('t_penjualan_detail')->insert($data);
    }
}
