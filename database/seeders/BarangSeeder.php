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
            // Supplier 1 (ID=1) - Kategori Elektronik (ID=1)
            ['barang_kode' => 'BRG001', 'barang_nama' => 'Laptop Acer', 'harga_beli' => 8000000, 'harga_jual' => 9000000, 'kategori_id' => 1, 'supplier_id' => 1],
            ['barang_kode' => 'BRG002', 'barang_nama' => 'Mouse Logitech', 'harga_beli' => 150000, 'harga_jual' => 180000, 'kategori_id' => 1, 'supplier_id' => 1],
            ['barang_kode' => 'BRG003', 'barang_nama' => 'Headset Gaming', 'harga_beli' => 300000, 'harga_jual' => 350000, 'kategori_id' => 1, 'supplier_id' => 1],
            ['barang_kode' => 'BRG004', 'barang_nama' => 'SSD 512GB', 'harga_beli' => 600000, 'harga_jual' => 700000, 'kategori_id' => 1, 'supplier_id' => 1],
            ['barang_kode' => 'BRG005', 'barang_nama' => 'Keyboard Mechanical', 'harga_beli' => 500000, 'harga_jual' => 600000, 'kategori_id' => 1, 'supplier_id' => 1],

            // Supplier 2 (ID=2) - Kategori Makanan & Minuman (ID=2 & 3)
            ['barang_kode' => 'BRG006', 'barang_nama' => 'Indomie Goreng', 'harga_beli' => 2500, 'harga_jual' => 3000, 'kategori_id' => 2, 'supplier_id' => 2],
            ['barang_kode' => 'BRG007', 'barang_nama' => 'Biskuit Roma', 'harga_beli' => 9000, 'harga_jual' => 10000, 'kategori_id' => 2, 'supplier_id' => 2],
            ['barang_kode' => 'BRG008', 'barang_nama' => 'Coca Cola 330ml', 'harga_beli' => 4000, 'harga_jual' => 5000, 'kategori_id' => 3, 'supplier_id' => 2],
            ['barang_kode' => 'BRG009', 'barang_nama' => 'Aqua 600ml', 'harga_beli' => 2500, 'harga_jual' => 3000, 'kategori_id' => 3, 'supplier_id' => 2],
            ['barang_kode' => 'BRG010', 'barang_nama' => 'Chiki Balls', 'harga_beli' => 1000, 'harga_jual' => 1500, 'kategori_id' => 2, 'supplier_id' => 2],

            // Supplier 3 (ID=3) - Kategori Pakaian (ID=4)
            ['barang_kode' => 'BRG011', 'barang_nama' => 'Kaos Polos Hitam', 'harga_beli' => 25000, 'harga_jual' => 35000, 'kategori_id' => 4, 'supplier_id' => 3],
            ['barang_kode' => 'BRG012', 'barang_nama' => 'Celana Jeans', 'harga_beli' => 80000, 'harga_jual' => 100000, 'kategori_id' => 4, 'supplier_id' => 3],
            ['barang_kode' => 'BRG013', 'barang_nama' => 'Topi Baseball', 'harga_beli' => 15000, 'harga_jual' => 20000, 'kategori_id' => 4, 'supplier_id' => 3],
            ['barang_kode' => 'BRG014', 'barang_nama' => 'Sweater Hoodie', 'harga_beli' => 60000, 'harga_jual' => 80000, 'kategori_id' => 4, 'supplier_id' => 3],
            ['barang_kode' => 'BRG015', 'barang_nama' => 'Sarung Tangan Musim Dingin', 'harga_beli' => 20000, 'harga_jual' => 25000, 'kategori_id' => 4, 'supplier_id' => 3],
        ];

        DB::table('m_barang')->insert($data);
    }
}
