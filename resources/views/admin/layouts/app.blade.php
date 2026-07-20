<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RoomEase Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f2] text-[#18221d] antialiased">
    <div class="min-h-screen">
        <header class="border-b border-[#e3e7df] bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-10">
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                        <span class="grid h-10 w-10 place-items-center rounded-full bg-[#1d3b2a] text-lg font-bold text-[#d8f36b]">R</span>
                        <div>
                            <p class="text-lg font-semibold">RoomEase Admin</p>
                            <p class="text-xs text-[#748078]">Hotel reservation management</p>
                        </div>
                    </a>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="rounded-full px-4 py-2 text-sm font-medium text-[#526057] hover:bg-[#f3f5f0]">Dashboard</a>
                    <a href="{{ route('admin.reservations.index') }}" class="rounded-full px-4 py-2 text-sm font-medium text-[#526057] hover:bg-[#f3f5f0]">Reservations</a>
                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="rounded-full bg-[#1d3b2a] px-5 py-2 text-sm font-semibold text-white hover:bg-[#31583f]">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 py-8 lg:px-10">
            @if (session('success'))
                <div class="mb-6 rounded-2xl bg-green-50 px-5 py-4 text-sm text-green-800">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>

