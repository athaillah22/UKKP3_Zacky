@extends('layout.admin')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">Edit Kategori</h2>
        
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Nama Kategori --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" required maxlength="100"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror"
                    placeholder="#">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi <span class="text-gray-400 text-xs">(Opsional)</span></label>
                <textarea name="deskripsi" rows="4" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('deskripsi') border-red-500 @enderror"
                    placeholder="Penjelasan singkat tentang kategori ini...">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Info Dibuat Oleh --}}
            <div class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <p class="text-sm text-gray-600">
                    <span class="font-medium">Dibuat oleh:</span> {{ $kategori->admin->name ?? 'N/A' }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Dibuat pada: {{ $kategori->created_at->format('d M Y H:i') }}
                </p>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3">
                <button type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Update
                </button>
                <a href="{{ route('admin.kategori.index') }}" 
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection