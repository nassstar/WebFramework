<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        // --- TAMBAHAN: Hapus data lama agar tidak duplicate ---
        // Kita perlu mematikan pengecekan Foreign Key sementara agar bisa truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus data di t_penjualan_detail dulu (karena ini anak dari t_penjualan)
        // Jika tidak dihapus, nanti data detailnya jadi "yatim piatu" atau error FK
        DB::table('t_penjualan_detail')->truncate();

        // Hapus data di t_penjualan
        DB::table('t_penjualan')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // -----------------------------------------------------

        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'penjualan_id' => $i,
                'user_id' => 1,
                'pembeli' => 'Pelanggan ' . $i,
                'penjualan_kode' => 'PJ-' . sprintf('%04d', $i),
                'penjualan_tanggal' => now(),
            ];
        }

        DB::table('t_penjualan')->insert($data);
    }
}
