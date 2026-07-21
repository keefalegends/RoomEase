@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">DASHBOARD</p>
        <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">Overview operasional hotel</h1>
        <p class="mt-3 max-w-2xl text-sm leading-6 text-[#748078]">Pantau performa reservasi, status kamar, dan aktivitas booking terbaru dari satu halaman.</p>
    </div>

    <!-- Stats Section -->
    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4">
        <!-- Revenue Card -->
        <div class="group relative overflow-hidden rounded-3xl border border-[#e5ebe0] bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-widest text-[#748078]">Pendapatan</span>
                <span class="rounded-xl bg-emerald-50 p-2.5 text-emerald-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </span>
            </div>
            <p class="mt-4 text-2xl font-bold tracking-tight text-[#1d3b2a]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <div class="mt-2 text-[11px] text-[#7c946a]">Seluruh pembayaran terkonfirmasi</div>
        </div>

        <!-- Total Reservations -->
        <div class="group relative overflow-hidden rounded-3xl border border-[#e5ebe0] bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-widest text-[#748078]">Total Reservasi</span>
                <span class="rounded-xl bg-indigo-50 p-2.5 text-indigo-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </span>
            </div>
            <p class="mt-4 text-2xl font-bold tracking-tight text-[#1d3b2a]">{{ $totalReservations }}</p>
            <div class="mt-2 text-[11px] text-[#748078]">{{ $todayReservations }} reservasi hari ini</div>
        </div>

        <!-- Available Rooms -->
        <div class="group relative overflow-hidden rounded-3xl border border-[#e5ebe0] bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-widest text-[#748078]">Kamar Tersedia</span>
                <span class="rounded-xl bg-green-50 p-2.5 text-green-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </span>
            </div>
            <p class="mt-4 text-2xl font-bold tracking-tight text-[#1d3b2a]">{{ $availableRooms }}</p>
            <div class="mt-2 text-[11px] text-[#7c946a]">Kamar berstatus 'available'</div>
        </div>

        <!-- Occupied Rooms -->
        <div class="group relative overflow-hidden rounded-3xl border border-[#e5ebe0] bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-widest text-[#748078]">Kamar Terisi</span>
                <span class="rounded-xl bg-amber-50 p-2.5 text-amber-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </span>
            </div>
            <p class="mt-4 text-2xl font-bold tracking-tight text-[#1d3b2a]">{{ $occupiedRooms }}</p>
            <div class="mt-2 text-[11px] text-[#748078]">Kamar berstatus 'occupied'</div>
        </div>
    </div>

    <!-- Mini stats (Pending & Confirmed) -->
    <div class="mt-5 grid gap-5 sm:grid-cols-2">
        <div class="flex items-center justify-between rounded-3xl border border-[#e5ebe0] bg-white px-6 py-4 shadow-sm">
            <div class="flex items-center gap-3">
                <span class="h-2.5 w-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                <span class="text-xs font-bold uppercase tracking-wider text-[#748078]">Reservasi Pending</span>
            </div>
            <span class="rounded-full bg-amber-50 px-3 py-1 text-sm font-bold text-amber-800">{{ $pendingReservations }}</span>
        </div>
        <div class="flex items-center justify-between rounded-3xl border border-[#e5ebe0] bg-white px-6 py-4 shadow-sm">
            <div class="flex items-center gap-3">
                <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                <span class="text-xs font-bold uppercase tracking-wider text-[#748078]">Reservasi Confirmed</span>
            </div>
            <span class="rounded-full bg-green-50 px-3 py-1 text-sm font-bold text-green-800">{{ $confirmedReservations }}</span>
        </div>
    </div>

    <!-- Recent Reservations Section -->
    <div class="mt-10 rounded-[2rem] border border-[#e5ebe0] bg-white p-6 shadow-sm sm:p-8">
        <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-[#1d3b2a]">Reservasi terbaru</h2>
                <p class="mt-1 text-sm text-[#748078]">Aktivitas booking yang baru masuk ke sistem.</p>
            </div>
            <a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#dce2d8] bg-white px-5 py-2.5 text-xs font-bold text-[#526057] transition-all hover:border-[#1d3b2a] hover:text-[#1d3b2a]">
                <span>Lihat semua</span>
                <span>→</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-[#edf1eb] text-xs font-bold uppercase tracking-wider text-[#748078]">
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Tamu</th>
                        <th class="px-4 py-3">Check-in</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Pembayaran</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1f4ef]">
                    @forelse ($recentReservations as $reservation)
                        <tr class="group transition-colors hover:bg-[#fcfcfa]">
                            <td class="px-4 py-4 font-bold text-[#1d3b2a]">{{ $reservation->reservation_code }}</td>
                            <td class="px-4 py-4">
                                <span class="font-medium text-[#18221d]">{{ $reservation->guest->name }}</span>
                            </td>
                            <td class="px-4 py-4 text-[#526057]">{{ $reservation->check_in->format('d M Y') }}</td>
                            <td class="px-4 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-amber-50 text-amber-800 border-amber-200',
                                        'confirmed' => 'bg-green-50 text-green-800 border-green-200',
                                        'checked_in' => 'bg-blue-50 text-blue-800 border-blue-200',
                                        'checked_out' => 'bg-[#f3f5f0] text-[#526057] border-[#dce2d8]',
                                        'cancelled' => 'bg-red-50 text-red-800 border-red-200',
                                    ];
                                @endphp
                                <span class="rounded-full border px-3 py-1 text-[10px] font-bold uppercase tracking-wider {{ $statusColors[$reservation->status] ?? 'bg-gray-50' }}">
                                    {{ str_replace('_', ' ', $reservation->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                @php
                                    $payColors = [
                                        'paid' => 'text-green-700 bg-green-50/50',
                                        'unpaid' => 'text-red-700 bg-red-50/50',
                                    ];
                                @endphp
                                <span class="rounded-lg px-2 py-0.5 text-xs font-semibold {{ $payColors[$reservation->payment?->status] ?? 'text-[#748078]' }}">
                                    {{ $reservation->payment?->status ? strtoupper($reservation->payment->status) : '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <a href="{{ route('admin.reservations.show', $reservation) }}" class="inline-flex items-center gap-1 rounded-full border border-[#dce2d8] bg-white px-3.5 py-1.5 text-xs font-bold text-[#1d3b2a] transition-all hover:bg-[#1d3b2a] hover:text-white group-hover:border-[#1d3b2a]">
                                    <span>Detail</span>
                                    <span>↗</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-sm text-[#748078]">Belum ada reservasi terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
