@extends('layout.customer')

@section('title', 'Pengaduan Saya')
@section('page-title', 'Pengaduan Saya')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Daftar Pengaduan Saya</h2>
    <a href="{{ route('customer.pengaduan.create') }}" 
       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Buat Pengaduan Baru
    </a>
</div>

@if(session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pengaduans as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->kategori->nama ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ Str::limit($item->judul, 40) }}</td>
                    <td class="px-6 py-4">
                        @php
                            $statusColor = match($item->status) {
                                'menunggu' => 'bg-yellow-100 text-yellow-700',
                                'proses' => 'bg-blue-100 text-blue-700',
                                'selesai' => 'bg-green-100 text-green-700',
                                default => 'bg-gray-100 text-gray-700'
                            };
                        @endphp
                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColor }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('customer.pengaduan.show', $item->id) }}" 
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        Anda belum pernah membuat pengaduan. 
                        <a href="{{ route('customer.pengaduan.create') }}" class="text-blue-600 hover:underline">Buat sekarang!</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($pengaduans->hasPages())
    <div class="p-4 border-t border-gray-200">
        {{ $pengaduans->links() }}
    </div>
    @endif
</div>
@endsection