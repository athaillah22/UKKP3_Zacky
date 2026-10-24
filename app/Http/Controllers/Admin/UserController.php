<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // 1. READ: Menampilkan daftar user
    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 2. CREATE: Menampilkan form tambah user
    public function create()
    {
        return view('admin.users.create');
    }

    // 3. STORE: Menyimpan data user baru (OTOMATIS JADI CUSTOMER)
    public function store(Request $request)
    {
        // Validasi HANYA name, email, dan password
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Simpan ke database, role dipaksa jadi 'customer'
        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'customer', // ✅ Otomatis, tidak bisa dimanipulasi
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    // 4. EDIT: Menampilkan form edit user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // 5. UPDATE: Memperbarui data user
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        // ✅ Role TIDAK DIUBAH, tetap sesuai data lama

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    // 6. DELETE: Menghapus data user
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil dihapus!');
    }
}