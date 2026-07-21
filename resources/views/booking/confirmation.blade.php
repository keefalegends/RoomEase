<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmed — RoomEase</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f2] text-[#18221d] antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center p-6 text-center">
        <span class="mb-6 grid h-16 w-16 place-items-center rounded-full bg-[#1d3b2a] text-3xl text-[#d8f36b]">✓</span>
        <p class="mb-3 text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">Booking confirmed</p>
        <h1 class="max-w-2xl text-5xl font-semibold leading-[0.98] tracking-[-0.07em] text-[#1d3b2a] sm:text-6xl">See you <span class="font-serif italic font-normal text-[#7c946a]">soon.</span></h1>
        
        <div class="mt-10 w-full max-w-md rounded-3xl border border-[#e1e6de] bg-white p-6 shadow-xl shadow-[#1d3b2a]/5 text-left">
            <h2 class="text-xl font-semibold tracking-[-0.04em] text-[#1d3b2a]">Reservation {{ $reservation->reservation_code }}</h2>
            <p class="mt-1 text-sm text-[#68766d]">Thank you, {{ explode(' ', $reservation->guest->name)[0] }}. Your stay is confirmed.</p>
            
            <div class="mt-6 space-y-4 rounded-xl bg-[#f5f7f2] p-4 text-sm">
                <div class="flex justify-between border-b border-[#dfe5dc] pb-3"><span class="text-[#68766d]">Room</span><strong class="text-[#1d3b2a]">{{ $roomType->name }} ({{ $room->room_number }})</strong></div>
                <div class="flex justify-between border-b border-[#dfe5dc] pb-3"><span class="text-[#68766d]">Dates</span><strong class="text-[#1d3b2a]">{{ $reservation->check_in->format('d M') }} — {{ $reservation->check_out->format('d M Y') }}</strong></div>
                <div class="flex justify-between border-b border-[#dfe5dc] pb-3"><span class="text-[#68766d]">Nights</span><strong class="text-[#1d3b2a]">{{ $nights }}</strong></div>
                <div class="flex justify-between"><span class="text-[#68766d]">Amount Paid</span><strong class="text-[#1d3b2a]">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</strong></div>
            </div>
            
            <p class="mt-5 text-center text-xs text-[#849087]">We've sent the details to {{ $reservation->guest->email ?? $reservation->guest->phone }}.</p>
        </div>
        
        <a href="{{ route('rooms.index') }}" class="mt-10 rounded-full border border-[#d7ddd2] bg-white px-6 py-3 text-sm font-semibold transition hover:border-[#1d3b2a] hover:bg-[#1d3b2a] hover:text-white">Return to home</a>
        <a href="{{ route('booking.invoice', $reservation->reservation_code) }}" class="mt-3 flex items-center gap-2 rounded-full bg-[#1d3b2a] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#31583f]">
            ↓ Download Invoice PDF
        </a>
    </div>
    @include('components.chat-widget')
</body>
</html>
