<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Sesuaikan dengan nama tabel di database Anda
    protected $table = 'kategori';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama',
        'deskripsi',
        'admin_id',
    ];

    /**
     * Relasi: Kategori dibuat oleh 1 Admin
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Relasi: Kategori memiliki banyak Pengaduan
     */
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id');
    }
}