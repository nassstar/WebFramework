<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable; // Penting untuk Auth
use Tymon\JWTAuth\Contracts\JWTSubject; // Jika nanti pakai JWT, tapi untuk sekarang abaikan

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'level_id',
        'username',
        'nama',
        'password',
        'avatar', // Tambah kolom avatar ke fillable,
        'image'
    ];

    protected $hidden = [
        'password', // Password tidak ikut saat di-select / return JSON
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed', // Password otomatis di-hash
        'email_verified_at' => 'datetime',
    ];

    // Relasi ke Tabel Level
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    // Mendapatkan nama role (misal: Administrator)
    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    // Cek apakah user memiliki role tertentu (Single Role Check)
    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }

    // Mendapatkan Kode Role (misal: ADM, MNG)
    public function getRole()
    {
        return $this->level->level_kode;
    }

    // protected function avatar(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($avatar) => $avatar ? asset('storage/photos/' . $avatar) : asset('user_default.png'),
    //     );
    // }
}
