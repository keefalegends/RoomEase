<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking — RoomEase</title>
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
                <a class="transition hover:text-[#18221d]" href="{{ route('rooms.index') }}">Our stays</a>
                <a class="transition hover:text-[#18221d]" href="/#experience">The experience</a>
                <a class="transition hover:text-[#18221d]" href="/#about">About us</a>
            </nav>
            <a href="{{ route('rooms.index') }}" class="rounded-full border border-[#d7ddd2] bg-white px-5 py-2.5 text-sm font-semibold transition hover:border-[#1d3b2a] hover:bg-[#1d3b2a] hover:text-white">Change room</a>
        </header>

        <main class="mx-auto max-w-7xl px-6 pb-20 pt-8 lg:px-10 lg:pt-12">
            <p class="mb-4 text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">Complete your booking</p>
            <div class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-end">
                <div>
                    <h1 class="max-w-2xl text-5xl font-semibold leading-[0.98] tracking-[-0.07em] text-[#1d3b2a] sm:text-6xl">Almost ready to <span class="font-serif italic font-normal text-[#7c946a]">stay.</span></h1>
                    <p class="mt-5 max-w-xl text-base leading-7 text-[#68766d]">Fill in your guest details. This page is still a frontend preview, so the booking is not saved to database yet.</p>
                </div>
                <span class="rounded-full bg-[#e9efe5] px-4 py-2 text-sm font-semibold text-[#1d3b2a]">Step 1 of 2</span>
            </div>

            <div class="grid gap-10 lg:grid-cols-[1fr_380px] lg:items-start">
                <form class="rounded-3xl border border-[#e1e6de] bg-white p-5 shadow-xl shadow-[#1d3b2a]/5 sm:p-8" action="{{ route('booking.store', $booking['room']) }}" method="post">
                    @csrf
                    <input type="hidden" name="room" value="{{ $booking['room'] }}">
                    <section>
                        <h2 class="text-2xl font-semibold tracking-[-0.04em] text-[#1d3b2a]">Guest information</h2>
                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <label class="block rounded-2xl border border-[#dfe5dc] px-4 py-3"><span class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Full name</span><input class="mt-2 w-full bg-transparent text-sm font-medium outline-none" type="text" name="name" placeholder="Your name" required></label>
                            <label class="block rounded-2xl border border-[#dfe5dc] px-4 py-3"><span class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">WhatsApp number</span><input class="mt-2 w-full bg-transparent text-sm font-medium outline-none" type="tel" name="phone" placeholder="08xxxxxxxxxx" required></label>
                            <label class="block rounded-2xl border border-[#dfe5dc] px-4 py-3"><span class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Email</span><input class="mt-2 w-full bg-transparent text-sm font-medium outline-none" type="email" name="email" placeholder="you@example.com"></label>
                            <label class="block rounded-2xl border border-[#dfe5dc] px-4 py-3"><span class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">NIK</span><input class="mt-2 w-full bg-transparent text-sm font-medium outline-none" type="text" name="nik" placeholder="Optional"></label>
                        </div>
                    </section>

                    @if ($errors->any())
                        <div class="mt-6 rounded-2xl bg-red-50 p-4 text-sm text-red-600">
                            <ul class="list-inside list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <section class="mt-10 border-t border-[#e5ebe2] pt-8">
                        <h2 class="text-2xl font-semibold tracking-[-0.04em] text-[#1d3b2a]">Stay details</h2>
                        <div class="mt-6 grid gap-4 sm:grid-cols-3">
                            <label class="block rounded-2xl border border-[#dfe5dc] px-4 py-3"><span class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Check in</span><input class="mt-2 w-full bg-transparent text-sm font-medium outline-none" type="date" name="check_in" value="{{ $booking['check_in'] }}" required></label>
                            <label class="block rounded-2xl border border-[#dfe5dc] px-4 py-3"><span class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Check out</span><input class="mt-2 w-full bg-transparent text-sm font-medium outline-none" type="date" name="check_out" value="{{ $booking['check_out'] }}" required></label>
                            <label class="block rounded-2xl border border-[#dfe5dc] px-4 py-3"><span class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Guests</span><select class="mt-2 w-full bg-transparent text-sm font-medium outline-none" name="guests"><option @selected($booking['guests'] === '1')>1</option><option @selected($booking['guests'] === '2')>2</option><option @selected($booking['guests'] === '3')>3</option><option @selected($booking['guests'] === '4')>4</option></select></label>
                        </div>
                    </section>

                    <button class="mt-8 w-full rounded-full bg-[#1d3b2a] px-6 py-4 text-sm font-bold text-white transition hover:bg-[#31583f] sm:w-auto" type="submit">Continue to payment <span class="ml-1">↗</span></button>
                </form>

                <aside class="rounded-3xl border border-[#e1e6de] bg-[#1d3b2a] p-5 text-white shadow-xl shadow-[#1d3b2a]/10 sm:p-6 lg:sticky lg:top-6">
                    <img class="aspect-[4/3] rounded-2xl object-cover" src="{{ $booking['image'] }}" alt="{{ $booking['name'] }}">
                    <div class="mt-5 flex items-start justify-between gap-4"><div><p class="text-xs font-bold uppercase tracking-[0.2em] text-[#d8f36b]">Selected room</p><h2 class="mt-2 text-2xl font-semibold tracking-[-0.04em]">{{ $booking['name'] }}</h2><p class="mt-1 text-sm text-[#bfd0c1]">{{ $booking['guests_label'] }} · {{ $booking['bed'] }}</p></div><p class="text-right text-sm"><strong class="block text-lg">Rp {{ $booking['price'] }}</strong><span class="text-[#bfd0c1]">/ night</span></p></div>
                    <div class="mt-6 space-y-3 border-t border-white/15 pt-5 text-sm text-[#dce8dd]">
                        <div class="flex justify-between"><span>Room rate</span><span>Rp {{ $booking['price'] }}</span></div>
                        <div class="flex justify-between"><span>Nights</span><span>{{ $booking['nights'] }}</span></div>
                        <div class="flex justify-between"><span>Service</span><span>Included</span></div>
                    </div>
                    <div class="mt-5 flex justify-between border-t border-white/15 pt-5 text-base font-bold">
                        <span>Estimated total</span><span>Rp {{ $booking['total_price'] }}</span>
                    </div>
                </aside>
            </div>
        </main>
    </div>
</body>
</html>
