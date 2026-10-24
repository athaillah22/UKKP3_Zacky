@extends('layout.admin')

@section('title', 'Detail Pengaduan')
@section('page-title', 'Detail Pengaduan')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    {{-- KOLOM KIRI: Detail Pengaduan --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-start mb-4">
                <h2 class="text-xl font-bold text-gray-800">{{ $pengaduan->judul }}</h2>
                <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                    {{ $pengaduan->created_at->format('d M Y, H:i') }}
                </span>
            </div>
            
            <div class="flex items-center gap-4 mb-6 text-sm text-gray-600">
                <span class="flex items-center gap-1">{{ $pengaduan->customer->name ?? 'N/A' }}</span>
                <span class="flex items-center gap-1">{{ $pengaduan->kategori->nama ?? 'N/A' }}</span>
            </div>

            <div class="prose max-w-none text-gray-700 mb-6">
                <p class="whitespace-pre-line">{{ $pengaduan->pengaduan }}</p>
            </div>

            @if($pengaduan->foto)
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-700 mb-2">Foto Bukti:</p>
                <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Bukti" class="max-w-md rounded-lg border border-gray-200">
            </div>
            @endif
        </div>
    </div>

    {{-- KOLOM KANAN: Form Update Status --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-20">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Update Status</h3>
            
            <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Saat Ini</label>
                    @php
                        $statusColor = match($pengaduan->status) {
                            'menunggu' => 'bg-yellow-100 text-yellow-700',
                            'proses' => 'bg-blue-100 text-blue-700',
                            'selesai' => 'bg-green-100 text-green-700',
                            default => 'bg-gray-100 text-gray-700'
                        };
                    @endphp
                    <span class="inline-block px-3 py-1 text-xs font-medium rounded-full {{ $statusColor }}">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ubah Status</label>
                    <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="menunggu" {{ $pengaduan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Sedang Diproses</option>
                        <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <button type="submit" class="w-full py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Update Status
                </button>
            </form>

            @if($pengaduan->admin)
            <div class="mt-4 pt-4 border-t border-gray-200 text-sm text-gray-600">
                <p><strong>Ditanggapi oleh:</strong> {{ $pengaduan->admin->name }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $pengaduan->updated_at->format('d M Y, H:i') }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection