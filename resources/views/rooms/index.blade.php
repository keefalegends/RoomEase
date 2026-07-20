<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rooms — RoomEase</title>
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
                <a class="text-[#1d3b2a]" href="/rooms">Our stays</a>
                <a class="transition hover:text-[#18221d]" href="/#experience">The experience</a>
                <a class="transition hover:text-[#18221d]" href="/#about">About us</a>
            </nav>
            <a href="/#search" class="rounded-full border border-[#d7ddd2] bg-white px-5 py-2.5 text-sm font-semibold transition hover:border-[#1d3b2a] hover:bg-[#1d3b2a] hover:text-white">Back home</a>
        </header>

        <main>
            <section class="mx-auto max-w-7xl px-6 pb-10 pt-12 lg:px-10 lg:pt-16">
                <p class="mb-4 text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">Find your stay</p>
                <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                    <div>
                        <h1 class="max-w-2xl text-5xl font-semibold leading-[0.98] tracking-[-0.07em] text-[#1d3b2a] sm:text-6xl">A room for every <span class="font-serif italic font-normal text-[#7c946a]">kind</span> of stay.</h1>
                        <p class="mt-5 max-w-lg text-base leading-7 text-[#68766d]">Take your pick from our thoughtfully designed rooms. Every stay comes with warm service and a little more space to slow down.</p>
                    </div>
                    <p class="text-sm text-[#849087]"><strong class="text-[#1d3b2a]">3 rooms</strong> available for your dates</p>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 lg:px-10">
                <form class="grid gap-3 rounded-2xl border border-[#e2e6df] bg-white p-3 shadow-lg shadow-[#1d3b2a]/5 md:grid-cols-[1.2fr_1fr_1fr_auto] md:items-center md:rounded-full md:p-2" action="/rooms" method="get">
                    <label class="flex items-center gap-3 rounded-full px-4 py-2.5 hover:bg-[#f5f7f2]"><span class="text-xl">⌖</span><span><small class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Location</small><span class="text-sm font-medium">RoomEase Hotel</span></span></label>
                    <label class="flex items-center gap-3 rounded-full px-4 py-2.5 hover:bg-[#f5f7f2]"><span class="text-xl">↘</span><span><small class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Check in</small><input class="w-24 bg-transparent text-sm font-medium outline-none" type="date" name="check_in" aria-label="Check in"></span></label>
                    <label class="flex items-center gap-3 rounded-full px-4 py-2.5 hover:bg-[#f5f7f2]"><span class="text-xl">↗</span><span><small class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Check out</small><input class="w-24 bg-transparent text-sm font-medium outline-none" type="date" name="check_out" aria-label="Check out"></span></label>
                    <button class="rounded-full bg-[#d8f36b] px-6 py-3.5 text-sm font-bold text-[#1d3b2a] transition hover:bg-[#c7e65c]" type="submit">Update search</button>
                </form>
            </section>

            <section class="mx-auto grid max-w-7xl gap-10 px-6 py-16 lg:grid-cols-[210px_1fr] lg:px-10">
                <aside>
                    <div class="sticky top-6">
                        <div class="flex items-center justify-between lg:block"><p class="text-xs font-bold uppercase tracking-[0.2em] text-[#849087]">Filter by</p><button class="text-sm text-[#7c946a] lg:hidden">Filters +</button></div>
                        <div class="mt-7 hidden space-y-7 lg:block">
                            <fieldset><legend class="mb-3 text-sm font-semibold text-[#1d3b2a]">Room type</legend><label class="flex items-center gap-3 py-1.5 text-sm text-[#68766d]"><input class="accent-[#1d3b2a]" type="checkbox" checked> All rooms</label><label class="flex items-center gap-3 py-1.5 text-sm text-[#68766d]"><input class="accent-[#1d3b2a]" type="checkbox"> Suites</label><label class="flex items-center gap-3 py-1.5 text-sm text-[#68766d]"><input class="accent-[#1d3b2a]" type="checkbox"> Essential</label></fieldset>
                            <fieldset><legend class="mb-3 text-sm font-semibold text-[#1d3b2a]">Guests</legend><label class="flex items-center gap-3 py-1.5 text-sm text-[#68766d]"><input class="accent-[#1d3b2a]" type="radio" name="guests" checked> Any capacity</label><label class="flex items-center gap-3 py-1.5 text-sm text-[#68766d]"><input class="accent-[#1d3b2a]" type="radio" name="guests"> 2+ guests</label><label class="flex items-center gap-3 py-1.5 text-sm text-[#68766d]"><input class="accent-[#1d3b2a]" type="radio" name="guests"> 4+ guests</label></fieldset>
                            <a href="/rooms" class="text-sm font-semibold text-[#526057] underline decoration-[#a7b69d] underline-offset-8">Clear filters</a>
                        </div>
                    </div>
                </aside>

                <div class="grid gap-x-6 gap-y-12 md:grid-cols-2">
                    @php
                        $rooms = [
                            ['slug' => 'essential', 'name' => 'The Essential', 'description' => 'Calm, considered, and everything you need.', 'guests' => '1–2 guests', 'bed' => 'King bed', 'price' => '850k', 'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=85'],
                            ['slug' => 'garden', 'name' => 'The Garden', 'description' => 'A bright room made for slow mornings.', 'guests' => '1–3 guests', 'bed' => 'King bed', 'price' => '1.1jt', 'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1000&q=85'],
                            ['slug' => 'garden-suite', 'name' => 'The Garden Suite', 'description' => 'More room, more light, more time together.', 'guests' => '1–4 guests', 'bed' => 'King bed', 'price' => '1.25jt', 'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1000&q=85'],
                            ['slug' => 'corner-suite', 'name' => 'The Corner Suite', 'description' => 'A little extra space with a view to match.', 'guests' => '1–4 guests', 'bed' => 'King bed', 'price' => '1.5jt', 'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1000&q=85'],
                        ];
                    @endphp
                    @foreach ($rooms as $room)
                        <article class="group">
                            <a href="{{ route('rooms.show', $room['slug']) }}" class="relative mb-5 block aspect-[4/3] overflow-hidden rounded-2xl bg-[#e2e9de]"><img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ $room['image'] }}" alt="{{ $room['name'] }}"><span class="absolute left-4 top-4 rounded-full bg-white/85 px-3 py-1.5 text-xs font-semibold text-[#1d3b2a] backdrop-blur-sm">Available</span></a>
                            <div class="flex justify-between gap-4"><div><h2 class="text-xl font-semibold tracking-[-0.03em] text-[#1d3b2a]">{{ $room['name'] }}</h2><p class="mt-1 text-sm text-[#748078]">{{ $room['description'] }}</p><p class="mt-3 text-xs text-[#849087]">{{ $room['guests'] }} <span class="mx-1">·</span> {{ $room['bed'] }} <span class="mx-1">·</span> Wi-Fi</p></div><p class="shrink-0 text-right text-sm"><strong class="block text-base text-[#1d3b2a]">Rp {{ $room['price'] }}</strong><span class="text-[#8a958c]">/ night</span></p></div>
                        </article>
                    @endforeach
                </div>
            </section>
        </main>

        <footer class="mx-auto flex max-w-7xl flex-col gap-5 border-t border-[#dfe5dc] px-6 py-8 text-sm text-[#78847a] sm:flex-row sm:items-center sm:justify-between lg:px-10"><p>© {{ date('Y') }} RoomEase. Stay beautifully.</p><div class="flex gap-6"><a class="hover:text-[#1d3b2a]" href="#">Instagram</a><a class="hover:text-[#1d3b2a]" href="#">Contact</a><a class="hover:text-[#1d3b2a]" href="#">Privacy</a></div></footer>
    </div>
</body>
</html>
