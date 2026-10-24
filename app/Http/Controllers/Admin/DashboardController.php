<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Mengimpor model User untuk akses database

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin.
     * Menampilkan ringkasan jumlah user terdaftar.
     */
    public function index()
    {
        // 1. Hitung total SEMUA user yang ada di tabel users
        $totalUsers = User::count();

        // 2. Hitung total user yang spesifik memiliki role 'customer'
        $totalCustomers = User::where('role', 'customer')->count();

        // 3. Hitung total user yang spesifik memiliki role 'admin'
        $totalAdmins = User::where('role', 'admin')->count();

        // 4. Kirim ketiga variabel tersebut ke file view 'admin.dashboard'
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCustomers',
            'totalAdmins'
        ));
    }
}