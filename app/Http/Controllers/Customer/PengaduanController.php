<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    // 1. Daftar pengaduan milik customer yang login
    public function index()
    {
        $pengaduans = Pengaduan::with(['kategori', 'admin'])
            ->where('customer_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('customer.pengaduan.index', compact('pengaduans'));
    }

    // 2. Form buat pengaduan baru
    public function create()
    {
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        return view('customer.pengaduan.create', compact('kategoris'));
    }

    // 3. Simpan pengaduan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'judul'       => 'required|string|max:255',
            'pengaduan'   => 'required|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // max 2MB
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_pengaduan', 'public');
        }

        Pengaduan::create([
            'customer_id' => Auth::id(),
            'kategori_id' => $validated['kategori_id'],
            'judul'       => $validated['judul'],
            'pengaduan'   => $validated['pengaduan'],
            'foto'        => $fotoPath,
            'status'      => 'menunggu',
            'admin_id'    => null,
        ]);

        return redirect()->route('customer.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim! Menunggu tanggapan admin.');
    }

    // 4. Lihat detail pengaduan + tanggapan admin
    public function show(Pengaduan $pengaduan)
    {
        // Pastikan hanya pemilik yang bisa lihat
        if ($pengaduan->customer_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pengaduan ini.');
        }

        $pengaduan->load(['kategori', 'admin']);
        return view('customer.pengaduan.show', compact('pengaduan'));
    }
}