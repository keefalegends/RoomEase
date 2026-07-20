<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment — RoomEase</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f2] text-[#18221d] antialiased">
    <div class="min-h-screen">
        <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-10">
            <a href="/" class="flex items-center gap-3"><span class="grid h-10 w-10 place-items-center rounded-full bg-[#1d3b2a] text-lg font-bold text-[#d8f36b]">R</span><span class="text-xl font-semibold tracking-[-0.04em]">RoomEase</span></a>
            <span class="rounded-full bg-[#e9efe5] px-4 py-2 text-sm font-semibold text-[#1d3b2a]">Step 2 of 2</span>
        </header>

        <main class="mx-auto max-w-7xl px-6 pb-20 pt-8 lg:px-10 lg:pt-12">
            <p class="mb-4 text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">Complete payment</p>
            <h1 class="max-w-2xl text-5xl font-semibold leading-[0.98] tracking-[-0.07em] text-[#1d3b2a] sm:text-6xl">Choose how to <span class="font-serif italic font-normal text-[#7c946a]">pay.</span></h1>
            <p class="mt-5 max-w-xl text-base leading-7 text-[#68766d]">Your reservation <strong class="text-[#1d3b2a]">{{ $reservation->reservation_code }}</strong> is ready. Pick a payment method to confirm your stay.</p>

            <div class="mt-12 grid gap-10 lg:grid-cols-[1fr_380px] lg:items-start">
                <form class="rounded-3xl border border-[#e1e6de] bg-white p-5 shadow-xl shadow-[#1d3b2a]/5 sm:p-8" action="{{ route('booking.pay', $reservation->reservation_code) }}" method="post">
                    @csrf
                    <h2 class="text-2xl font-semibold tracking-[-0.04em] text-[#1d3b2a]">Payment method</h2>
                    <div class="mt-6 space-y-3">
                        <label class="flex cursor-pointer items-center gap-4 rounded-2xl border border-[#dfe5dc] px-5 py-4 transition has-[:checked]:border-[#1d3b2a] has-[:checked]:bg-[#f0f5ed]"><input class="accent-[#1d3b2a]" type="radio" name="payment_method" value="cash" checked><div><strong class="block text-sm text-[#1d3b2a]">Cash</strong><span class="text-xs text-[#849087]">Pay at the front desk on arrival</span></div></label>
                        <label class="flex cursor-pointer items-center gap-4 rounded-2xl border border-[#dfe5dc] px-5 py-4 transition has-[:checked]:border-[#1d3b2a] has-[:checked]:bg-[#f0f5ed]"><input class="accent-[#1d3b2a]" type="radio" name="payment_method" value="transfer"><div><strong class="block text-sm text-[#1d3b2a]">Bank Transfer</strong><span class="text-xs text-[#849087]">Transfer to our bank account</span></div></label>
                        <label class="flex cursor-pointer items-center gap-4 rounded-2xl border border-[#dfe5dc] px-5 py-4 transition has-[:checked]:border-[#1d3b2a] has-[:checked]:bg-[#f0f5ed]"><input class="accent-[#1d3b2a]" type="radio" name="payment_method" value="e-wallet"><div><strong class="block text-sm text-[#1d3b2a]">E-Wallet</strong><span class="text-xs text-[#849087]">GoPay, OVO, DANA, ShopeePay</span></div></label>
                    </div>

                    <section class="mt-8 border-t border-[#e5ebe2] pt-6">
                        <h2 class="text-2xl font-semibold tracking-[-0.04em] text-[#1d3b2a]">Guest details</h2>
                        <div class="mt-4 space-y-2 text-sm text-[#68766d]">
                            <p><strong class="text-[#1d3b2a]">{{ $reservation->guest->name }}</strong></p>
                            <p>{{ $reservation->guest->phone }}@if($reservation->guest->email) · {{ $reservation->guest->email }}@endif</p>
                            <p>Check-in <strong class="text-[#1d3b2a]">{{ $reservation->check_in->format('d M Y') }}</strong> → Check-out <strong class="text-[#1d3b2a]">{{ $reservation->check_out->format('d M Y') }}</strong></p>
                            <p>Room <strong class="text-[#1d3b2a]">{{ $room->room_number }}</strong> · {{ $roomType->name }}</p>
                        </div>
                    </section>

                    <button class="mt-8 w-full rounded-full bg-[#1d3b2a] px-6 py-4 text-sm font-bold text-white transition hover:bg-[#31583f] sm:w-auto" type="submit">Confirm & pay Rp {{ number_format($reservation->total_price, 0, ',', '.') }} <span class="ml-1">↗</span></button>
                </form>

                <aside class="rounded-3xl border border-[#e1e6de] bg-[#1d3b2a] p-5 text-white shadow-xl shadow-[#1d3b2a]/10 sm:p-6 lg:sticky lg:top-6">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#d8f36b]">Booking summary</p>
                    <h2 class="mt-3 text-2xl font-semibold tracking-[-0.04em]">{{ $roomType->name }}</h2>
                    <p class="mt-1 text-sm text-[#bfd0c1]">Room {{ $room->room_number }} · 1–{{ $roomType->capacity }} guests · King bed</p>
                    <div class="mt-6 space-y-3 border-t border-white/15 pt-5 text-sm text-[#dce8dd]">
                        <div class="flex justify-between"><span>Room rate</span><span>Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}</span></div>
                        <div class="flex justify-between"><span>Nights</span><span>{{ $nights }}</span></div>
                        <div class="flex justify-between"><span>Service</span><span>Included</span></div>
                    </div>
                    <div class="mt-5 flex justify-between border-t border-white/15 pt-5 text-base font-bold">
                        <span>Total</span><span>Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
                    </div>
                    <p class="mt-4 text-center text-xs text-[#bfd0c1]">Code: {{ $reservation->reservation_code }}</p>
                </aside>
            </div>
        </main>
    </div>
</body>
</html>
