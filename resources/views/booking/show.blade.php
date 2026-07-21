<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Reservasi {{ $reservation->reservation_code }} — RoomEase</title>
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

        <main class="mx-auto w-full max-w-4xl px-6 py-12">
            <div class="mb-8">
                <a href="{{ route('booking.lookup') }}" class="inline-flex items-center gap-2 text-sm font-medium text-[#526057] hover:text-[#1d3b2a]">← Cek Kode Lain</a>
            </div>

            <div class="grid gap-8 lg:grid-cols-[1.3fr_0.7fr]">
                <div class="rounded-3xl bg-white p-8 shadow-xl shadow-[#1d3b2a]/5">
                    <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between border-b border-[#edf1eb] pb-6">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">Reservation Details</p>
                            <h1 class="mt-1 text-2xl font-semibold text-[#1d3b2a]">{{ $reservation->reservation_code }}</h1>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-amber-50 text-amber-800 border-amber-200',
                                    'confirmed' => 'bg-green-50 text-green-800 border-green-200',
                                    'checked_in' => 'bg-blue-50 text-blue-800 border-blue-200',
                                    'checked_out' => 'bg-gray-50 text-gray-800 border-gray-200',
                                    'cancelled' => 'bg-red-50 text-red-800 border-red-200',
                                ];
                            @endphp
                            <span class="rounded-full border px-4 py-1.5 text-xs font-bold uppercase tracking-wider {{ $statusColors[$reservation->status] ?? 'bg-gray-50 text-gray-800 border-gray-200' }}">
                                {{ str_replace('_', ' ', $reservation->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2 text-sm">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-[#748078]">Nama Tamu</p>
                            <p class="mt-1.5 font-semibold text-[#1d3b2a]">{{ $reservation->guest->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-[#748078]">WhatsApp / Phone</p>
                            <p class="mt-1.5 font-semibold text-[#1d3b2a]">{{ $reservation->guest->phone }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-[#748078]">Email</p>
                            <p class="mt-1.5 font-semibold text-[#1d3b2a]">{{ $reservation->guest->email ?: '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-[#edf1eb] pt-8">
                        <h2 class="text-lg font-semibold text-[#1d3b2a] mb-4">Detail Kamar</h2>
                        <div class="rounded-2xl bg-[#fcfcf9] border border-[#e8ebe6] p-5 flex items-start gap-4">
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg text-[#1d3b2a]">{{ $roomType->name }}</h3>
                                <p class="text-sm text-[#748078] mt-1">{{ $roomType->description }}</p>
                                <p class="text-xs text-[#748078] mt-3">Nomor Kamar: <strong class="text-[#1d3b2a] font-semibold">{{ $room->room_number }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <div class="rounded-3xl bg-white p-6 shadow-xl shadow-[#1d3b2a]/5">
                        <h2 class="text-lg font-semibold text-[#1d3b2a] border-b border-[#edf1eb] pb-4 mb-4">Rincian Menginap</h2>
                        <div class="grid gap-4 text-sm">
                            <div class="flex justify-between">
                                <span class="text-[#748078]">Check In</span>
                                <span class="font-semibold">{{ $reservation->check_in->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#748078]">Check Out</span>
                                <span class="font-semibold">{{ $reservation->check_out->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between border-t border-[#f1f4ef] pt-3">
                                <span class="text-[#748078]">Durasi</span>
                                <span class="font-semibold">{{ $nights }} malam</span>
                            </div>
                            <div class="flex justify-between border-t border-[#edf1eb] pt-3 text-base">
                                <span class="font-semibold text-[#1d3b2a]">Total Tagihan</span>
                                <span class="font-bold text-[#1d3b2a]">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white p-6 shadow-xl shadow-[#1d3b2a]/5">
                        <h2 class="text-lg font-semibold text-[#1d3b2a] border-b border-[#edf1eb] pb-4 mb-4">Status Pembayaran</h2>
                        <div class="grid gap-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-[#748078]">Metode</span>
                                <span class="font-semibold uppercase">{{ $reservation->payment?->payment_method ?: '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#748078]">Status</span>
                                <span class="font-bold uppercase {{ $reservation->payment?->status === 'paid' ? 'text-green-600' : 'text-amber-600' }}">
                                    {{ $reservation->payment?->status ?? 'unpaid' }}
                                </span>
                            </div>
                            @if ($reservation->payment?->status === 'unpaid')
                                <a href="{{ route('booking.payment', $reservation->reservation_code) }}" 
                                   class="mt-4 w-full text-center rounded-full bg-[#1d3b2a] py-3 text-sm font-semibold text-white hover:bg-[#31583f]">
                                     Lakukan Pembayaran
                                 </a>
                            @else
                                <a href="{{ route('booking.invoice', $reservation->reservation_code) }}" 
                                   class="mt-4 w-full text-center rounded-full border border-[#d7ddd2] bg-white py-3 text-sm font-semibold text-[#1d3b2a] hover:border-[#1d3b2a] hover:bg-[#f7f7f2]">
                                    ↓ Download Invoice PDF
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="mx-auto w-full max-w-7xl px-6 py-8 text-center text-sm text-[#78847a] lg:px-10">
            <p>© {{ date('Y') }} RoomEase. Stay beautifully.</p>
        </footer>
    </div>
    @include('components.chat-widget')
</body>
</html>
