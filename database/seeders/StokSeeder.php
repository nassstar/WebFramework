<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ambil semua ID barang yang BENAR-BENAR ADA di tabel m_barang
        $barangIds = DB::table('m_barang')->pluck('barang_id');

        // 2. Siapkan array penampung
        $data = [];

        // 3. Loop berdasarkan ID barang yang ada
        foreach ($barangIds as $id) {
            $data[] = [
                'barang_id' => $id,
                'user_id' => 1, // Pastikan user dengan ID 1 ada
                'stok_tanggal' => now(),
                'stok_jumlah' => rand(10, 50), // Stok acak
            ];
        }

        // 4. Masukkan ke database
        DB::table('t_stok')->insert($data);
    }
}
