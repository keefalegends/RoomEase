<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RoomEase — Stay beautifully</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f2] text-[#18221d] antialiased">
    <div class="min-h-screen overflow-hidden">
        <header class="relative z-10 mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-10">
            <a href="/" class="flex items-center gap-3" aria-label="RoomEase home">
                <span class="grid h-10 w-10 place-items-center rounded-full bg-[#1d3b2a] text-lg font-bold text-[#d8f36b]">R</span>
                <span class="text-xl font-semibold tracking-[-0.04em]">RoomEase</span>
            </a>
            <nav class="hidden items-center gap-9 text-sm font-medium text-[#526057] md:flex" aria-label="Main navigation">
                <a class="transition hover:text-[#18221d]" href="#stays">Our stays</a>
                <a class="transition hover:text-[#18221d]" href="{{ route('booking.lookup') }}">Cek Reservasi</a>
                <a class="transition hover:text-[#18221d]" href="#about">About us</a>
            </nav>
            <a href="{{ route('rooms.index') }}" class="rounded-full border border-[#d7ddd2] bg-white px-5 py-2.5 text-sm font-semibold transition hover:border-[#1d3b2a] hover:bg-[#1d3b2a] hover:text-white">Find a room</a>
        </header>

        <main>
            <section class="mx-auto grid max-w-7xl items-center gap-12 px-6 pb-20 pt-10 lg:grid-cols-[0.9fr_1.1fr] lg:px-10 lg:pb-28 lg:pt-16">
                <div class="max-w-xl">
                    <p class="mb-6 flex items-center gap-3 text-xs font-bold uppercase tracking-[0.24em] text-[#77847a]"><span class="h-px w-8 bg-[#a7b69d]"></span> Hospitality, made simple</p>
                    <h1 class="max-w-lg text-5xl font-semibold leading-[0.98] tracking-[-0.07em] text-[#1d3b2a] sm:text-6xl lg:text-7xl">A better way to <span class="font-serif italic font-normal text-[#7c946a]">stay.</span></h1>
                    <p class="mt-7 max-w-md text-base leading-7 text-[#627067]">Find a place that feels like yours. Thoughtfully designed rooms, warm service, and an easy booking experience from start to finish.</p>
                    <a href="{{ route('rooms.index') }}" class="mt-9 inline-flex items-center gap-3 rounded-full bg-[#1d3b2a] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#1d3b2a]/15 transition hover:-translate-y-0.5 hover:bg-[#31583f]">Explore rooms <span aria-hidden="true">↗</span></a>
                    <div class="mt-14 flex items-center gap-8 border-t border-[#dce2d8] pt-6 text-sm text-[#68766d]"><span><strong class="block text-xl font-semibold text-[#1d3b2a]">12+</strong> room styles</span><span><strong class="block text-xl font-semibold text-[#1d3b2a]">4.9/5</strong> guest rating</span></div>
                </div>
                <div class="relative min-h-[480px] overflow-hidden rounded-[2rem] bg-[#dce5d5] shadow-2xl shadow-[#1d3b2a]/10 lg:min-h-[610px]">
                    <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1400&q=85" alt="Interior kamar hotel yang hangat dan modern">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#18221d]/45 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 flex items-end justify-between text-white"><div><p class="text-xs uppercase tracking-[0.2em] text-white/70">Room 204</p><p class="mt-1 text-2xl font-medium tracking-tight">The Garden Suite</p></div><span class="rounded-full bg-white/15 px-4 py-2 text-sm backdrop-blur-md">From Rp 1.250.000</span></div>
                </div>
            </section>

            <section id="search" class="relative z-10 mx-auto -mt-3 max-w-5xl px-6 lg:px-10">
                <form class="grid gap-3 rounded-2xl border border-[#e2e6df] bg-white p-3 shadow-xl shadow-[#1d3b2a]/10 md:grid-cols-[1.3fr_1fr_1fr_auto] md:items-center md:rounded-full md:p-2" action="{{ route('rooms.index') }}" method="get">
                    <label class="flex items-center gap-3 rounded-full px-4 py-2.5 text-left hover:bg-[#f5f7f2]"><span class="text-xl">⌖</span><span><small class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Location</small><span class="text-sm font-medium">RoomEase Hotel</span></span></label>
                    <label class="flex items-center gap-3 rounded-full px-4 py-2.5 text-left hover:bg-[#f5f7f2]"><span class="text-xl">↘</span><span><small class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Check in</small><span class="text-sm font-medium text-[#849087]">Add dates</span></span></label>
                    <label class="flex items-center gap-3 rounded-full px-4 py-2.5 text-left hover:bg-[#f5f7f2]"><span class="text-xl">↗</span><span><small class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Check out</small><span class="text-sm font-medium text-[#849087]">Add dates</span></span></label>
                    <button class="rounded-full bg-[#d8f36b] px-6 py-3.5 text-sm font-bold text-[#1d3b2a] transition hover:bg-[#c7e65c]" type="submit">Search stays</button>
                </form>
            </section>

            <section id="stays" class="mx-auto max-w-7xl px-6 py-24 lg:px-10">
                <div class="mb-10 flex items-end justify-between"><div><p class="mb-3 text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">Stay your way</p><h2 class="text-4xl font-semibold tracking-[-0.06em] text-[#1d3b2a]">Rooms with room to breathe.</h2></div><a href="{{ route('rooms.index') }}" class="hidden text-sm font-semibold text-[#526057] underline decoration-[#a7b69d] underline-offset-8 md:block">View all rooms ↗</a></div>
                <div class="grid gap-6 md:grid-cols-3">
                    <article class="group"><div class="mb-5 aspect-[4/3] overflow-hidden rounded-2xl bg-[#e2e9de]"><img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=900&q=80" alt="Standard room"><span class="absolute"></span></div><div class="flex justify-between gap-3"><div><h3 class="text-xl font-semibold text-[#1d3b2a]">The Essential</h3><p class="mt-1 text-sm text-[#748078]">1–2 guests · King bed</p></div><p class="text-right text-sm"><strong class="block text-base text-[#1d3b2a]">Rp 850k</strong><span class="text-[#8a958c]">/ night</span></p></div></article>
                    <article class="group"><div class="mb-5 aspect-[4/3] overflow-hidden rounded-2xl bg-[#e2e9de]"><img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=900&q=80" alt="Deluxe room"></div><div class="flex justify-between gap-3"><div><h3 class="text-xl font-semibold text-[#1d3b2a]">The Garden</h3><p class="mt-1 text-sm text-[#748078]">1–3 guests · King bed</p></div><p class="text-right text-sm"><strong class="block text-base text-[#1d3b2a]">Rp 1.1jt</strong><span class="text-[#8a958c]">/ night</span></p></div></article>
                    <article class="group"><div class="mb-5 aspect-[4/3] overflow-hidden rounded-2xl bg-[#e2e9de]"><img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=900&q=80" alt="Suite room"></div><div class="flex justify-between gap-3"><div><h3 class="text-xl font-semibold text-[#1d3b2a]">The Garden Suite</h3><p class="mt-1 text-sm text-[#748078]">1–4 guests · King bed</p></div><p class="text-right text-sm"><strong class="block text-base text-[#1d3b2a]">Rp 1.25jt</strong><span class="text-[#8a958c]">/ night</span></p></div></article>
                </div>
            </section>

            <section id="experience" class="bg-[#1d3b2a] text-white"><div class="mx-auto grid max-w-7xl gap-12 px-6 py-20 lg:grid-cols-2 lg:items-center lg:px-10 lg:py-24"><div><p class="mb-4 text-xs font-bold uppercase tracking-[0.24em] text-[#d8f36b]">The RoomEase feeling</p><h2 class="max-w-lg text-4xl font-semibold leading-tight tracking-[-0.06em] sm:text-5xl">Small details. <span class="font-serif italic font-normal text-[#d8f36b]">Big comfort.</span></h2></div><p class="max-w-md text-base leading-7 text-[#bfd0c1]">From the first welcome to the last coffee, we make space for the moments that matter. Stay at your own pace, with everything you need close at hand.</p></div></section>
        </main>

        <footer id="about" class="mx-auto flex max-w-7xl flex-col gap-5 px-6 py-8 text-sm text-[#78847a] sm:flex-row sm:items-center sm:justify-between lg:px-10"><p>© {{ date('Y') }} RoomEase. Stay beautifully.</p><div class="flex gap-6"><a class="hover:text-[#1d3b2a]" href="#">Instagram</a><a class="hover:text-[#1d3b2a]" href="#">Contact</a><a class="hover:text-[#1d3b2a]" href="#">Privacy</a></div></footer>
    </div>
</body>
</html>
