<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // UBAHAN DI SINI: 
        // Opsi 1: Urutkan berdasarkan NAMA secara ASC (A-Z) -> Paling disarankan untuk kategori
        $kategoris = Kategori::with('admin')->orderBy('nama', 'asc')->paginate(10);
        
        // Opsi 2: Jika ingin urutkan berdasarkan WAKTU PEMBUATAN (Terlama ke Terbaru)
        // $kategoris = Kategori::with('admin')->orderBy('created_at', 'asc')->paginate(10);

        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'],
            'admin_id' => auth()->id(), // Auto-set admin yang membuat
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        return view('admin.kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update([
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'],
            // admin_id tidak diubah, tetap yang pertama kali membuat
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        // Cek apakah ada pengaduan yang menggunakan kategori ini
        // Pastikan di Model Kategori sudah ada relasi: public function pengaduans() { return $this->hasMany(Pengaduan::class); }
        if ($kategori->pengaduans()->count() > 0) {
            return redirect()->route('admin.kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh pengaduan!');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}