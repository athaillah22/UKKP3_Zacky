@extends('layout.customer')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- Welcome Card --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}</h2>
        <p class="text-gray-500 mt-1">Selamat datang di aplikasi pengaduan.</p>
    </div>

    {{-- Statistik Pengaduan --}}
    @php
        $totalPengaduan = \App\Models\Pengaduan::where('customer_id', Auth::id())->count();
        $menunggu = \App\Models\Pengaduan::where('customer_id', Auth::id())->where('status', 'menunggu')->count();
        $proses = \App\Models\Pengaduan::where('customer_id', Auth::id())->where('status', 'proses')->count();
        $selesai = \App\Models\Pengaduan::where('customer_id', Auth::id())->where('status', 'selesai')->count();
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Total Pengaduan</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalPengaduan }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Menunggu</p>
            <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $menunggu }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Diproses</p>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $proses }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Selesai</p>
            <p class="text-3xl font-bold text-green-600 mt-1">{{ $selesai }}</p>
        </div>
    </div>
</div>
@endsection