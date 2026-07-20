<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Reservasi — RoomEase</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f2] text-[#18221d] antialiased">
    <div class="min-h-screen flex flex-col justify-between">
        <header class="mx-auto flex w-full max-w-7xl items-center justify-between px-6 py-6 lg:px-10">
            <a href="/" class="flex items-center gap-3">
                <span class="grid h-10 w-10 place-items-center rounded-full bg-[#1d3b2a] text-lg font-bold text-[#d8f36b]">R</span>
                <span class="text-xl font-semibold tracking-[-0.04em]">RoomEase</span>
            </a>
            <a href="{{ route('rooms.index') }}" class="rounded-full border border-[#d7ddd2] bg-white px-5 py-2.5 text-sm font-semibold transition hover:border-[#1d3b2a] hover:bg-[#1d3b2a] hover:text-white">Find a room</a>
        </header>

        <main class="mx-auto my-auto w-full max-w-xl px-6 py-12">
            <div class="rounded-3xl bg-white p-8 shadow-xl shadow-[#1d3b2a]/5">
                <div class="mb-8 text-center">
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a] mb-2">Customer Portal</p>
                    <h1 class="text-3xl font-semibold tracking-tight text-[#1d3b2a]">Cek Status Reservasi</h1>
                    <p class="mt-2 text-sm text-[#748078]">Masukkan kode reservasi unik Anda untuk melihat rincian pemesanan.</p>
                </div>

                @if (session('error'))
                    <div class="mb-6 rounded-xl bg-red-50 p-4 text-sm text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('booking.lookup.find') }}" method="get" class="grid gap-5">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-[#526057]">Kode Reservasi</label>
                        <input type="text" name="code" value="{{ request('code') }}" placeholder="Contoh: RE-20260720-ABCDE" required uppercase
                            class="w-full rounded-xl border border-[#dce2d8] px-4 py-3 outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a] placeholder-[#abb4ae]">
                    </div>
                    <button type="submit" class="w-full rounded-full bg-[#1d3b2a] py-3.5 font-semibold text-white transition hover:bg-[#31583f]">
                        Cek Booking
                    </button>
                </form>
            </div>
        </main>

        <footer class="mx-auto w-full max-w-7xl px-6 py-8 text-center text-sm text-[#78847a] lg:px-10">
            <p>© {{ date('Y') }} RoomEase. Stay beautifully.</p>
        </footer>
    </div>
</body>
</html>
