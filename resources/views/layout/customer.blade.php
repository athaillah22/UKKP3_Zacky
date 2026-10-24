<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Customer')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <div class="flex min-h-screen">
        {{-- SIDEBAR --}}
        <aside class="w-64 bg-white border-r border-gray-200 fixed h-full flex flex-col">
            {{-- Logo --}}
            <div class="h-14 flex items-center px-6 border-b border-gray-200 shrink-0">
                <span class="text-lg font-bold text-blue-600">Aplikasi Pengaduan</span>
            </div>

            {{-- Menu --}}
            <nav class="p-4 space-y-1 flex-1 overflow-y-auto">

                {{-- 1. dashboard --}}
                <a href="{{ route('customer.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('customer.pengaduan.create') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    Buat Pengaduan
                </a>
                {{-- 2. Buat Pengaduan --}}
                <a href="{{ route('customer.pengaduan.create') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('customer.pengaduan.create') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    Buat Pengaduan
                </a>

                {{-- 3. Daftar Pengaduan Saya --}}
                <a href="{{ route('customer.pengaduan.index') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('customer.pengaduan.index') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                   
                    Pengaduan Saya
                </a>

                {{-- 4. Edit Profil --}}
                <a href="{{ route('customer.profile.edit') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('customer.profile.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                   
                    Edit Profil
                </a>

            </nav>

            {{-- Logout --}}
            <div class="p-4 border-t border-gray-200 shrink-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 w-full transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <div class="flex-1 ml-64 flex flex-col min-h-screen">
            {{-- TOPBAR --}}
            <header class="h-14 bg-white border-b border-gray-200 flex items-center justify-between px-6 sticky top-0 z-10 shrink-0">
                <div class="flex items-center gap-4">
                    <h1 class="text-lg font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                    <div class="h-9 w-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold text-sm border border-blue-200">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            {{-- CONTENT AREA --}}
            <main class="flex-1 p-6 bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>