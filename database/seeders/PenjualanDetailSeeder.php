<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detail = [];
        $penjualanId = 1;

        // Buat 30 detail, 3 per penjualan (10 penjualan)
        for ($i = 1; $i <= 30; $i++) {
            $detail[] = [
                'penjualan_id' => $penjualanId,
                'barang_id' => rand(1, 15), // Ambil barang acak dari 15 barang
                'harga' => rand(2000, 100000), // Harga acak
                'jumlah' => rand(1, 5), // Jumlah acak 1-5
            ];

            if ($i % 3 == 0) { // Setiap 3 detail, naik ke penjualan berikutnya
                $penjualanId++;
            }
        }

        DB::table('t_penjualan_detail')->insert($detail);
    }
}
