<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    // 1. Daftar semua pengaduan
    public function index()
    {
        $pengaduans = Pengaduan::with(['customer', 'kategori', 'admin'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    // 2. Lihat detail pengaduan
    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load(['customer', 'kategori', 'admin']);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    // 3. Update status & admin_id (tanggapi)
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,proses,selesai',
        ]);

        $pengaduan->update([
            'status' => $validated['status'],
            'admin_id' => auth()->id(), // Admin yang menanggapi
        ]);

        return redirect()->route('admin.pengaduan.index')
            ->with('success', 'Status pengaduan berhasil diperbarui!');
    }
}