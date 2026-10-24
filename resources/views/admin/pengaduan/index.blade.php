@extends('layout.admin')

@section('title', 'Kelola Pengaduan')
@section('page-title', 'Kelola Pengaduan')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Pelapor</th>
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
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->customer->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->kategori->nama ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ Str::limit($item->judul, 30) }}</td>
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
                        <a href="{{ route('admin.pengaduan.show', $item->id) }}" 
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data pengaduan
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