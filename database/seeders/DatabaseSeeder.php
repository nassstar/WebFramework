<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            LevelSeeder::class,      // Pastikan level dibuat dulu
            UserSeeder::class,       // Baru user
            KategoriSeeder::class,   // Kategori barang
            SupplierSeeder::class,   // Supplier
            BarangSeeder::class,     // Barang
            StokSeeder::class,       // Stok
            PenjualanSeeder::class,  // Transaksi
            PenjualanDetailSeeder::class, // Detail Transaksi
        ]);
    }
}
