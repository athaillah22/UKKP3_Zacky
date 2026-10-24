@extends('layout.customer')

@section('title', 'Buat Pengaduan')
@section('page-title', 'Buat Pengaduan')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Form Pengaduan Baru</h2>

        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('customer.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- Kategori --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Pengaduan <span class="text-red-500">*</span></label>
                <select name="kategori_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kategori_id') border-red-500 @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Judul --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Pengaduan <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul') }}" required maxlength="255"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-500 @enderror"
                    placeholder="Contoh: Makanan basi, Pelayanan tidak ramah, dll">
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Detail Pengaduan --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Detail Pengaduan <span class="text-red-500">*</span></label>
                <textarea name="pengaduan" rows="6" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('pengaduan') border-red-500 @enderror"
                    placeholder="Jelaskan keluhan Anda secara detail...">{{ old('pengaduan') }}</textarea>
                @error('pengaduan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Upload Foto --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Upload Foto Bukti <span class="text-gray-400 text-xs">(Opsional, maks 2MB)</span>
                </label>
                <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('foto') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                @error('foto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3">
                <button type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Kirim Pengaduan
                </button>
                <a href="{{ route('customer.pengaduan.index') }}" 
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection