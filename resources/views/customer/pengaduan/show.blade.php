@extends('layout.customer')

@section('title', 'Detail Pengaduan')
@section('page-title', 'Detail Pengaduan')

@section('content')
<div class="max-w-4xl space-y-6">
    
    {{-- Tombol Kembali --}}
    <a href="{{ route('customer.pengaduan.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Daftar Pengaduan
    </a>

    {{-- Card Detail Pengaduan --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-start mb-4">
            <h2 class="text-xl font-bold text-gray-800">{{ $pengaduan->judul }}</h2>
            @php
                $statusColor = match($pengaduan->status) {
                    'menunggu' => 'bg-yellow-100 text-yellow-700',
                    'proses' => 'bg-blue-100 text-blue-700',
                    'selesai' => 'bg-green-100 text-green-700',
                    default => 'bg-gray-100 text-gray-700'
                };
            @endphp
            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColor }}">
                {{ ucfirst($pengaduan->status) }}
            </span>
        </div>
        
        <div class="flex items-center gap-4 mb-6 text-sm text-gray-600">
            <span class="flex items-center gap-1"> {{ $pengaduan->created_at->format('d M Y, H:i') }}</span>
            <span class="flex items-center gap-1"> {{ $pengaduan->kategori->nama ?? 'N/A' }}</span>
        </div>

        <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Detail Pengaduan:</h3>
            <p class="text-gray-700 whitespace-pre-line bg-gray-50 p-4 rounded-lg border border-gray-200">
                {{ $pengaduan->pengaduan }}
            </p>
        </div>

        @if($pengaduan->foto)
        <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-2">Foto Bukti:</h3>
            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Bukti" class="max-w-md rounded-lg border border-gray-200">
        </div>
        @endif
    </div>

    {{-- Card Tanggapan Admin --}}
    @if($pengaduan->admin && $pengaduan->status === 'selesai')
    <div class="bg-green-50 rounded-lg border border-green-200 p-6">
        <h3 class="text-sm font-semibold text-green-800 mb-3 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Tanggapan dari Admin ({{ $pengaduan->admin->name }})
        </h3>
        <div class="bg-white p-4 rounded-lg border border-green-200">
            <p class="text-gray-700 whitespace-pre-line">
                {{ $pengaduan->tanggapan ?? 'Pengaduan Anda telah diselesaikan. Terima kasih atas laporannya.' }}
            </p>
            <p class="text-xs text-gray-500 mt-3">
                Dibalas pada: {{ $pengaduan->updated_at->format('d M Y, H:i') }}
            </p>
        </div>
    </div>
    @elseif($pengaduan->status === 'proses')
    <div class="bg-blue-50 rounded-lg border border-blue-200 p-6">
        <h3 class="text-sm font-semibold text-blue-800 flex items-center gap-2">
            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Pengaduan Anda sedang diproses oleh admin. Mohon tunggu...
        </h3>
    </div>
    @else
    <div class="bg-yellow-50 rounded-lg border border-yellow-200 p-6">
        <h3 class="text-sm font-semibold text-yellow-800 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Pengaduan Anda masih menunggu tanggapan dari admin.
        </h3>
    </div>
    @endif

</div>
@endsection