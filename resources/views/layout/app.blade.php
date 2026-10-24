<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Athaillah Shop')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">Aplikasi pengduan</a>

            <div class="flex items-center gap-4">
                @auth
                    <span class="text-sm text-gray-700">
                        Halo, <strong>{{ Auth::user()->name }}</strong>
                        <span class="text-xs text-gray-500">({{ Auth::user()->role }})</span>
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-sm bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Konten dari halaman lain akan muncul di sini --}}
    <main>
        @yield('content')
    </main>

</body>
</html>