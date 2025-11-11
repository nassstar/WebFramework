<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_kode' => 'SP01',
                'supplier_nama' => 'PT ABC Elektronik',
                'supplier_alamat' => 'Jl. Teknologi No. 1, Malang'
            ],
            [
                'supplier_kode' => 'SP02',
                'supplier_nama' => 'CV XYZ Konsumsi',
                'supplier_alamat' => 'Jl. Industri No. 2, Surabaya'
            ],
            [
                'supplier_kode' => 'SP03',
                'supplier_nama' => 'Toko Langgeng Pakaian',
                'supplier_alamat' => 'Jl. Fashion No. 3, Jakarta'
            ],
        ];
        DB::table('m_supplier')->insert($data);
    }
}
