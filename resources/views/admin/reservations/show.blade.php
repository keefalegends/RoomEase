@extends('admin.layouts.app')

@section('title', 'Detail Reservasi')

@section('content')
    @php $detail = $reservation->reservationDetails->first(); @endphp

    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#7c946a]">Reservation Detail</p>
            <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">{{ $reservation->reservation_code }}</h1>
            <p class="mt-3 text-sm text-[#748078]">Kelola data reservasi tamu dan update status booking.</p>
        </div>
        <a href="{{ route('admin.reservations.index') }}" class="rounded-full border border-[#dce2d8] px-5 py-3 text-sm font-medium hover:border-[#1d3b2a] hover:text-[#1d3b2a]">← Kembali ke daftar</a>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
        <div class="rounded-3xl bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-semibold text-[#1d3b2a]">Informasi Tamu</h2>
            <div class="mt-5 grid gap-4 sm:grid-cols-2 text-sm">
                <div><p class="text-[#748078]">Nama</p><p class="mt-1 font-medium">{{ $reservation->guest->name }}</p></div>
                <div><p class="text-[#748078]">Phone</p><p class="mt-1 font-medium">{{ $reservation->guest->phone }}</p></div>
                <div><p class="text-[#748078]">Email</p><p class="mt-1 font-medium">{{ $reservation->guest->email ?: '-' }}</p></div>
                <div><p class="text-[#748078]">NIK</p><p class="mt-1 font-medium">{{ $reservation->guest->nik ?: '-' }}</p></div>
            </div>

            <div class="mt-8 border-t border-[#edf1eb] pt-8">
                <h2 class="text-2xl font-semibold text-[#1d3b2a]">Informasi Booking</h2>
                <div class="mt-5 grid gap-4 sm:grid-cols-2 text-sm">
                    <div><p class="text-[#748078]">Room Type</p><p class="mt-1 font-medium">{{ $detail?->room?->roomType?->name ?? '-' }}</p></div>
                    <div><p class="text-[#748078]">Nomor Kamar</p><p class="mt-1 font-medium">{{ $detail?->room?->room_number ?? '-' }}</p></div>
                    <div><p class="text-[#748078]">Check In</p><p class="mt-1 font-medium">{{ $reservation->check_in->format('d M Y') }}</p></div>
                    <div><p class="text-[#748078]">Check Out</p><p class="mt-1 font-medium">{{ $reservation->check_out->format('d M Y') }}</p></div>
                    <div><p class="text-[#748078]">Jumlah Malam</p><p class="mt-1 font-medium">{{ $nights }} malam</p></div>
                    <div><p class="text-[#748078]">Total Harga</p><p class="mt-1 font-medium">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</p></div>
                </div>
            </div>

            <div class="mt-8 border-t border-[#edf1eb] pt-8">
                <h2 class="text-2xl font-semibold text-[#1d3b2a]">Pembayaran</h2>
                <div class="mt-5 grid gap-4 sm:grid-cols-2 text-sm">
                    <div><p class="text-[#748078]">Metode</p><p class="mt-1 font-medium">{{ $reservation->payment?->payment_method ? ucwords(str_replace('-', ' ', $reservation->payment->payment_method)) : '-' }}</p></div>
                    <div><p class="text-[#748078]">Status</p><p class="mt-1 font-medium">{{ $reservation->payment?->status ?? '-' }}</p></div>
                    <div><p class="text-[#748078]">Tanggal Bayar</p><p class="mt-1 font-medium">{{ $reservation->payment?->payment_date?->format('d M Y H:i') ?? '-' }}</p></div>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-semibold text-[#1d3b2a]">Update Status</h2>
            <p class="mt-2 text-sm text-[#748078]">Status saat ini: <span class="font-semibold uppercase text-[#1d3b2a]">{{ str_replace('_', ' ', $reservation->status) }}</span></p>

            <form action="{{ route('admin.reservations.update-status', $reservation) }}" method="post" class="mt-6 grid gap-4">
                @csrf
                @method('PATCH')
                <select name="status" class="rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                    @foreach (['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected($reservation->status === $status)>{{ ucwords(str_replace('_', ' ', $status)) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-full bg-[#1d3b2a] px-6 py-3 font-semibold text-white hover:bg-[#31583f]">Simpan status</button>
            </form>
        </div>
    </div>
@endsection
