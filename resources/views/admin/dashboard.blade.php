@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="mb-8">
        <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#7c946a]">Dashboard</p>
        <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">Overview operasional hotel</h1>
        <p class="mt-3 max-w-2xl text-sm leading-6 text-[#748078]">Pantau performa reservasi, status kamar, dan aktivitas booking terbaru dari satu halaman.</p>
    </div>

    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm text-[#748078]">Total Reservasi</p><p class="mt-3 text-3xl font-semibold">{{ $totalReservations }}</p></div>
        <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm text-[#748078]">Reservasi Hari Ini</p><p class="mt-3 text-3xl font-semibold">{{ $todayReservations }}</p></div>
        <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm text-[#748078]">Pending</p><p class="mt-3 text-3xl font-semibold">{{ $pendingReservations }}</p></div>
        <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm text-[#748078]">Confirmed</p><p class="mt-3 text-3xl font-semibold">{{ $confirmedReservations }}</p></div>
        <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm text-[#748078]">Pendapatan</p><p class="mt-3 text-3xl font-semibold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p></div>
        <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm text-[#748078]">Kamar Tersedia</p><p class="mt-3 text-3xl font-semibold">{{ $availableRooms }}</p></div>
        <div class="rounded-3xl bg-white p-6 shadow-sm"><p class="text-sm text-[#748078]">Kamar Terisi</p><p class="mt-3 text-3xl font-semibold">{{ $occupiedRooms }}</p></div>
    </div>

    <div class="mt-10 rounded-3xl bg-white p-6 shadow-sm">
        <div class="mb-5 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-[#1d3b2a]">Reservasi terbaru</h2>
                <p class="mt-1 text-sm text-[#748078]">Activity feed booking yang baru masuk.</p>
            </div>
            <a href="{{ route('admin.reservations.index') }}" class="rounded-full border border-[#dce2d8] px-4 py-2 text-sm font-medium hover:border-[#1d3b2a] hover:text-[#1d3b2a]">Lihat semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-[#edf1eb] text-[#748078]">
                        <th class="px-4 py-3 font-medium">Kode</th>
                        <th class="px-4 py-3 font-medium">Tamu</th>
                        <th class="px-4 py-3 font-medium">Check-in</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3 font-medium">Pembayaran</th>
                        <th class="px-4 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentReservations as $reservation)
                        <tr class="border-b border-[#f1f4ef]">
                            <td class="px-4 py-4 font-semibold">{{ $reservation->reservation_code }}</td>
                            <td class="px-4 py-4">{{ $reservation->guest->name }}</td>
                            <td class="px-4 py-4">{{ $reservation->check_in->format('d M Y') }}</td>
                            <td class="px-4 py-4"><span class="rounded-full bg-[#f3f5f0] px-3 py-1 text-xs font-semibold uppercase">{{ str_replace('_', ' ', $reservation->status) }}</span></td>
                            <td class="px-4 py-4">{{ $reservation->payment?->status ?? '-' }}</td>
                            <td class="px-4 py-4"><a href="{{ route('admin.reservations.show', $reservation) }}" class="font-medium text-[#1d3b2a] hover:underline">Detail</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-6 text-center text-[#748078]">Belum ada reservasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
