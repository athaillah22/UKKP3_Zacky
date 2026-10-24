@extends('layout.admin')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- ============================================ --}}
{{-- STATISTIK CARDS --}}
{{-- ============================================ --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

    {{-- Card 1: Total User --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total User</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalUsers ?? 0 }}</p>
                <p class="text-xs text-gray-400 mt-2">Semua pengguna terdaftar</p>
            </div>
            <div class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Card 2: Total Admin --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Admin</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalAdmins ?? 0 }}</p>
                <p class="text-xs text-gray-400 mt-2">Pengelola sistem</p>
            </div>
            <div class="h-14 w-14 rounded-full bg-green-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Card 3: Total Customer --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Customer</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalCustomers ?? 0 }}</p>
                <p class="text-xs text-gray-400 mt-2">Pelanggan aktif</p>
            </div>
            <div class="h-14 w-14 rounded-full bg-yellow-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Card 4: Status Sistem --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Status</p>
                <p class="text-3xl font-bold text-green-600">Aktif</p>
                <p class="text-xs text-gray-400 mt-2">Server berjalan normal</p>
            </div>
            <div class="h-14 w-14 rounded-full bg-red-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                </svg>
            </div>
        </div>
    </div>

</div>

{{-- ============================================ --}}
{{-- INFO SYSTEM CARD --}}
{{-- ============================================ --}}
<div class="bg-white rounded-lg border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-base font-semibold text-gray-800">Informasi Sistem</h3>
    </div>
    <div class="p-6">
        <div class="space-y-3">
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="text-sm text-gray-600">Login Sebagai</span>
                <span class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="text-sm text-gray-600">Email</span>
                <span class="text-sm font-medium text-gray-800">{{ Auth::user()->email }}</span>
            </div>
            <div class="flex justify-between items-center py-2">
                <span class="text-sm text-gray-600">Role</span>
                <span class="text-sm font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">{{ ucfirst(Auth::user()->role) }}</span>
            </div>
        </div>
    </div>
</div>

@endsection