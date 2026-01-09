<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $table = 'm_supplier';

    // Mendefinisikan primary key dari tabel yang digunakan
    protected $primaryKey = 'supplier_id';

    // Mendefinisikan field yang boleh diisi (mass assignment)
    protected $fillable = [
        'supplier_kode',
        'supplier_nama',
        'supplier_alamat'
    ];
}
