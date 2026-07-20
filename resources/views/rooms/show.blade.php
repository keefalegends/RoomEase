<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $room['name'] }} — RoomEase</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f2] text-[#18221d] antialiased">
    <div class="min-h-screen">
        <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-10">
            <a href="/" class="flex items-center gap-3" aria-label="RoomEase home">
                <span class="grid h-10 w-10 place-items-center rounded-full bg-[#1d3b2a] text-lg font-bold text-[#d8f36b]">R</span>
                <span class="text-xl font-semibold tracking-[-0.04em]">RoomEase</span>
            </a>
            <nav class="hidden items-center gap-8 text-sm font-medium text-[#526057] md:flex">
                <a class="text-[#1d3b2a]" href="{{ route('rooms.index') }}">Our stays</a>
                <a class="transition hover:text-[#18221d]" href="/#experience">The experience</a>
                <a class="transition hover:text-[#18221d]" href="/#about">About us</a>
            </nav>
            <a href="{{ route('rooms.index') }}" class="rounded-full border border-[#d7ddd2] bg-white px-5 py-2.5 text-sm font-semibold transition hover:border-[#1d3b2a] hover:bg-[#1d3b2a] hover:text-white">All rooms</a>
        </header>

        <main class="mx-auto max-w-7xl px-6 pb-20 pt-8 lg:px-10 lg:pt-12">
            <a href="{{ route('rooms.index') }}" class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-[#68766d] transition hover:text-[#1d3b2a]">← Back to rooms</a>
            <div class="grid gap-12 lg:grid-cols-[1.15fr_0.85fr] lg:items-start">
                <div>
                    <div class="relative overflow-hidden rounded-[2rem] bg-[#dce5d5]">
                        <img class="aspect-[4/3] h-full w-full object-cover" src="{{ $room['image'] }}" alt="{{ $room['name'] }}">
                        <span class="absolute left-5 top-5 rounded-full bg-white/90 px-4 py-2 text-xs font-bold text-[#1d3b2a] shadow-sm backdrop-blur-sm">Available now</span>
                    </div>
                    <div class="mt-8 grid grid-cols-3 gap-3">
                        @foreach ([$room['image'], 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=500&q=80', 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=500&q=80'] as $image)
                            <img class="aspect-[4/3] rounded-xl object-cover" src="{{ $image }}" alt="Detail {{ $room['name'] }}">
                        @endforeach
                    </div>
                </div>

                <div class="lg:pt-4">
                    <p class="mb-4 text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">{{ $room['type'] }} room</p>
                    <h1 class="text-5xl font-semibold leading-[0.98] tracking-[-0.07em] text-[#1d3b2a] sm:text-6xl">{{ $room['name'] }}</h1>
                    <p class="mt-6 text-base leading-7 text-[#68766d]">{{ $room['description'] }} Designed with natural textures, soft light, and thoughtful details for a stay that feels easy from the moment you arrive.</p>
                    <div class="mt-8 flex flex-wrap gap-3 text-sm text-[#526057]"><span class="rounded-full bg-[#e9efe5] px-4 py-2">{{ $room['guests'] }}</span><span class="rounded-full bg-[#e9efe5] px-4 py-2">{{ $room['bed'] }}</span><span class="rounded-full bg-[#e9efe5] px-4 py-2">Wi-Fi included</span></div>

                    <form class="mt-10 rounded-2xl border border-[#e1e6de] bg-white p-5 shadow-xl shadow-[#1d3b2a]/5" action="{{ route('booking.create', $room['slug'] ?? request()->route('room')) }}" method="get">
                        <div class="mb-5 flex items-end justify-between"><div><p class="text-xs font-bold uppercase tracking-[0.2em] text-[#849087]">Reserve this room</p><p class="mt-2 text-sm text-[#68766d]">Choose your dates to see the total.</p></div><p class="text-right"><strong class="block text-xl text-[#1d3b2a]">Rp {{ $room['price'] }}</strong><span class="text-xs text-[#8a958c]">per night</span></p></div>
                        <div class="grid gap-3 sm:grid-cols-2"><label class="rounded-xl border border-[#dfe5dc] px-4 py-3"><span class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Check in</span><input class="mt-1 w-full bg-transparent text-sm font-medium outline-none" type="date" name="check_in" required></label><label class="rounded-xl border border-[#dfe5dc] px-4 py-3"><span class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Check out</span><input class="mt-1 w-full bg-transparent text-sm font-medium outline-none" type="date" name="check_out" required></label></div>
                        <label class="mt-3 block rounded-xl border border-[#dfe5dc] px-4 py-3"><span class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Guests</span><select class="mt-1 w-full bg-transparent text-sm font-medium outline-none" name="guests"><option>1 guest</option><option>2 guests</option><option>3 guests</option><option>4 guests</option></select></label>
                        <button class="mt-4 w-full rounded-full bg-[#1d3b2a] px-6 py-3.5 text-sm font-bold text-white transition hover:bg-[#31583f]" type="submit">Reserve this room <span class="ml-1">↗</span></button>
                        <p class="mt-3 text-center text-xs text-[#849087]">You won't be charged yet.</p>
                    </form>
                </div>
            </div>

            <section class="mt-20 border-t border-[#dfe5dc] pt-12"><p class="mb-4 text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">Included with your stay</p><div class="grid gap-8 text-sm text-[#68766d] sm:grid-cols-2 lg:grid-cols-4"><div><strong class="mb-2 block text-[#1d3b2a]">Sleep well</strong>Premium linens, blackout curtains, and a king-size bed.</div><div><strong class="mb-2 block text-[#1d3b2a]">Stay connected</strong>Fast Wi-Fi and a comfortable workspace in every room.</div><div><strong class="mb-2 block text-[#1d3b2a]">Start slow</strong>Fresh coffee and breakfast options available every morning.</div><div><strong class="mb-2 block text-[#1d3b2a]">Feel at home</strong>Warm service whenever you need a hand.</div></div></section>
        </main>

        <footer class="mx-auto flex max-w-7xl flex-col gap-5 border-t border-[#dfe5dc] px-6 py-8 text-sm text-[#78847a] sm:flex-row sm:items-center sm:justify-between lg:px-10"><p>© {{ date('Y') }} RoomEase. Stay beautifully.</p><div class="flex gap-6"><a class="hover:text-[#1d3b2a]" href="#">Instagram</a><a class="hover:text-[#1d3b2a]" href="#">Contact</a><a class="hover:text-[#1d3b2a]" href="#">Privacy</a></div></footer>
    </div>
</body>
</html>
