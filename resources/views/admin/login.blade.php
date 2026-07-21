<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — RoomEase Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f2] text-[#18221d] antialiased">
    <div class="flex min-h-screen items-center justify-center p-6">
        <div class="w-full max-w-md">
            <!-- Card -->
            <div class="rounded-[2rem] border border-[#e5ebe0] bg-white p-8 shadow-xl shadow-[#1d3b2a]/5 sm:p-10">
                <!-- Branding -->
                <div class="mb-8 text-center">
                    <div class="mx-auto mb-5 grid h-14 w-14 place-items-center rounded-2xl bg-[#1d3b2a] text-2xl font-bold text-[#d8f36b] shadow-lg shadow-[#1d3b2a]/20">R</div>
                    <h1 class="text-2xl font-bold tracking-tight text-[#1d3b2a]">Selamat datang kembali</h1>
                    <p class="mt-2 text-sm text-[#748078]">Masuk ke RoomEase Admin Panel</p>
                </div>

                <!-- Alerts -->
                @if (session('error') || session('success'))
                    <div class="mb-6 flex items-center gap-3 rounded-2xl border px-4 py-3 text-sm font-medium {{ session('error') ? 'border-red-200 bg-red-50 text-red-900' : 'border-emerald-200 bg-emerald-50 text-emerald-900' }}">
                        <span class="grid h-5 w-5 place-items-center rounded-full text-xs font-bold {{ session('error') ? 'bg-red-200 text-red-800' : 'bg-emerald-200 text-emerald-800' }}">
                            {{ session('error') ? '✕' : '✓' }}
                        </span>
                        <span>{{ session('error') ?? session('success') }}</span>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('admin.login.post') }}" method="post" class="grid gap-5">
                    @csrf
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#748078]">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3.5 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-2 focus:ring-[#1d3b2a]/10"
                            placeholder="admin@roomease.com">
                        @error('email')<span class="mt-1 block text-xs font-medium text-red-600">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#748078]">Password</label>
                        <input type="password" name="password" required
                            class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3.5 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-2 focus:ring-[#1d3b2a]/10"
                            placeholder="••••••••">
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-[#dce2d8] text-[#1d3b2a] focus:ring-[#1d3b2a]">
                        <label for="remember" class="text-xs font-medium text-[#526057]">Ingat saya di perangkat ini</label>
                    </div>
                    <button type="submit" class="mt-2 w-full rounded-full bg-[#1d3b2a] py-4 text-sm font-bold text-white transition hover:bg-[#31583f]">
                        Masuk ke Admin Panel
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <p class="mt-6 text-center text-xs text-[#748078]">© {{ date('Y') }} RoomEase — Hotel Management System</p>
        </div>
    </div>
</body>
</html>
