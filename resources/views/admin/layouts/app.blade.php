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
        <header class="sticky top-0 z-30 border-b border-[#e5ebe0] bg-white/95 backdrop-blur-md">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-3.5 lg:px-10">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3">
                    <span class="grid h-10 w-10 place-items-center rounded-2xl bg-[#1d3b2a] text-lg font-bold text-[#d8f36b] shadow-sm transition-transform duration-300 group-hover:scale-105">R</span>
                    <div>
                        <p class="text-base font-bold tracking-tight text-[#1d3b2a]">RoomEase <span class="rounded-md bg-[#eef3ea] px-2 py-0.5 text-xs font-semibold text-[#536b59]">Admin</span></p>
                        <p class="text-[11px] text-[#748078]">Hotel Management System</p>
                    </div>
                </a>

                <div class="flex items-center gap-2 sm:gap-3">
                    <nav class="hidden items-center gap-1 rounded-full border border-[#e5ebe0] bg-[#f7f7f2] p-1 md:flex">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="rounded-full px-4 py-1.5 text-xs font-semibold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#1d3b2a] text-white shadow-sm' : 'text-[#526057] hover:text-[#1d3b2a]' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.reservations.index') }}" 
                           class="rounded-full px-4 py-1.5 text-xs font-semibold transition-all {{ request()->routeIs('admin.reservations.*') ? 'bg-[#1d3b2a] text-white shadow-sm' : 'text-[#526057] hover:text-[#1d3b2a]' }}">
                            Reservations
                        </a>
                        <a href="{{ route('admin.room-types.index') }}" 
                           class="rounded-full px-4 py-1.5 text-xs font-semibold transition-all {{ request()->routeIs('admin.room-types.*') ? 'bg-[#1d3b2a] text-white shadow-sm' : 'text-[#526057] hover:text-[#1d3b2a]' }}">
                            Room Types
                        </a>
                        <a href="{{ route('admin.rooms.index') }}" 
                           class="rounded-full px-4 py-1.5 text-xs font-semibold transition-all {{ request()->routeIs('admin.rooms.*') ? 'bg-[#1d3b2a] text-white shadow-sm' : 'text-[#526057] hover:text-[#1d3b2a]' }}">
                            Rooms
                        </a>
                    </nav>

                    <form action="{{ route('admin.logout') }}" method="post" class="ml-2">
                        @csrf
                        <button type="submit" class="flex items-center gap-1.5 rounded-full border border-[#dce2d8] bg-white px-4 py-2 text-xs font-bold text-[#526057] transition-all hover:border-[#1d3b2a] hover:bg-[#1d3b2a] hover:text-white">
                            <span>Logout</span>
                            <span class="text-xs">↗</span>
                        </button>
                    </form>
                </div>
            </div>
            <!-- Mobile Navigation -->
            <div class="flex border-t border-[#e5ebe0] px-4 py-2 md:hidden overflow-x-auto gap-2">
                <a href="{{ route('admin.dashboard') }}" class="whitespace-nowrap rounded-full px-3 py-1 text-xs font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-[#1d3b2a] text-white' : 'bg-[#f0f3ed] text-[#526057]' }}">Dashboard</a>
                <a href="{{ route('admin.reservations.index') }}" class="whitespace-nowrap rounded-full px-3 py-1 text-xs font-semibold {{ request()->routeIs('admin.reservations.*') ? 'bg-[#1d3b2a] text-white' : 'bg-[#f0f3ed] text-[#526057]' }}">Reservations</a>
                <a href="{{ route('admin.room-types.index') }}" class="whitespace-nowrap rounded-full px-3 py-1 text-xs font-semibold {{ request()->routeIs('admin.room-types.*') ? 'bg-[#1d3b2a] text-white' : 'bg-[#f0f3ed] text-[#526057]' }}">Room Types</a>
                <a href="{{ route('admin.rooms.index') }}" class="whitespace-nowrap rounded-full px-3 py-1 text-xs font-semibold {{ request()->routeIs('admin.rooms.*') ? 'bg-[#1d3b2a] text-white' : 'bg-[#f0f3ed] text-[#526057]' }}">Rooms</a>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 py-8 lg:px-10">
            @if (session('success'))
                <div class="mb-6 flex items-center justify-between rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-900 shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="grid h-6 w-6 place-items-center rounded-full bg-emerald-200 text-xs font-bold text-emerald-800">✓</span>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 flex items-center justify-between rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-900 shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="grid h-6 w-6 place-items-center rounded-full bg-red-200 text-xs font-bold text-red-800">✕</span>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
