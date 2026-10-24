<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'customer_id',
        'kategori_id',
        'admin_id',
        'judul',
        'pengaduan',
        'foto',
        'status',
    ];

    // Tambahkan casts untuk mengonversi JSON ke Array PHP
    protected $casts = [
        'foto' => 'array', 
        // Anda juga bisa menggunakan 'foto' => 'json' di Laravel versi terbaru
    ];

    // Relasi ke Customer (User dengan role customer)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi ke Admin (User dengan role admin)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}