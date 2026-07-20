<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RoomEase Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f2] text-[#18221d] antialiased">
    <div class="flex min-h-screen items-center justify-center p-6">
        <div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-xl shadow-[#1d3b2a]/5">
            <div class="mb-8 text-center">
                <div class="mx-auto mb-4 grid h-12 w-12 place-items-center rounded-full bg-[#1d3b2a] text-xl font-bold text-[#d8f36b]">R</div>
                <h1 class="text-2xl font-semibold text-[#1d3b2a]">Admin Login</h1>
                <p class="text-sm text-[#748078]">RoomEase Management System</p>
            </div>

            @if (session('error') || session('success'))
            <div class="mb-6 rounded-xl p-4 text-sm {{ session('error') ? 'bg-red-50 text-red-800' : 'bg-green-50 text-green-800' }}">
                {{ session('error') ?? session('success') }}
            </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="post" class="grid gap-5">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-medium text-[#526057]">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-xl border border-[#dce2d8] px-4 py-3 outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                    @error('email')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-[#526057]">Password</label>
                    <input type="password" name="password" required
                        class="w-full rounded-xl border border-[#dce2d8] px-4 py-3 outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-[#dce2d8] text-[#1d3b2a] focus:ring-[#1d3b2a]">
                    <label for="remember" class="text-sm text-[#526057]">Remember me</label>
                </div>
                <button type="submit" class="mt-2 w-full rounded-full bg-[#1d3b2a] py-3.5 font-semibold text-white transition hover:bg-[#31583f]">
                    Sign in to Admin
                </button>
            </form>
        </div>
    </div>
</body>
</html>
