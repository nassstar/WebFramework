<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil semua ID barang yang ada
        $barang = DB::table('m_barang')->get();

        // 2. Ambil semua ID penjualan yang ada
        $penjualanIds = DB::table('t_penjualan')->pluck('penjualan_id');

        $data = [];

        // 3. Loop setiap transaksi penjualan, kita buatkan 3 detail barang per transaksi
        foreach ($penjualanIds as $penjualanId) {

            // Ambil 3 barang acak dari database
            $randomBarang = $barang->random(3);

            foreach ($randomBarang as $brg) {
                $data[] = [
                    'penjualan_id' => $penjualanId,
                    'barang_id'    => $brg->barang_id, // Pasti valid karena ambil dari DB
                    'harga'        => $brg->harga_jual,
                    'jumlah'       => rand(1, 5),
                ];
            }
        }

        // 4. Masukkan data ke database
        DB::table('t_penjualan_detail')->insert($data);
    }
}
