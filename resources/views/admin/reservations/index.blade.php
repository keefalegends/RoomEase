@extends('admin.layouts.app')

@section('title', 'Manajemen Reservasi — Admin')

@section('content')
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">RESERVATIONS</p>
            <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">Manajemen reservasi</h1>
            <p class="mt-3 max-w-2xl text-sm leading-6 text-[#748078]">Lihat, cari, dan kelola seluruh booking tamu di RoomEase.</p>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="mb-6 rounded-3xl border border-[#e5ebe0] bg-white p-5 shadow-sm sm:p-6">
        <form method="get" class="grid gap-4 md:grid-cols-[1fr_220px_auto]">
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-[#748078]">Pencarian</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode booking / nama / no HP"
                    class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-[#748078]">Status Booking</label>
                <select name="status" class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                    <option value="">Semua status</option>
                    @foreach (['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucwords(str_replace('_', ' ', $status)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="w-full rounded-full bg-[#1d3b2a] px-6 py-3.5 text-xs font-bold text-white transition hover:bg-[#31583f] md:w-auto">
                    Terapkan Filter
                </button>
                @if (request('search') || request('status'))
                    <a href="{{ route('admin.reservations.index') }}" class="rounded-full border border-[#dce2d8] bg-white px-4 py-3.5 text-xs font-bold text-[#748078] hover:text-[#1d3b2a]">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="rounded-[2rem] border border-[#e5ebe0] bg-white p-6 shadow-sm sm:p-8">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-[#edf1eb] text-xs font-bold uppercase tracking-wider text-[#748078]">
                        <th class="px-4 py-3">Kode Booking</th>
                        <th class="px-4 py-3">Informasi Tamu</th>
                        <th class="px-4 py-3">Kamar</th>
                        <th class="px-4 py-3">Jadwal Check-in</th>
                        <th class="px-4 py-3">Total Biaya</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1f4ef]">
                    @forelse ($reservations as $reservation)
                        @php $detail = $reservation->reservationDetails->first(); @endphp
                        <tr class="group transition-colors hover:bg-[#fcfcfa]">
                            <td class="px-4 py-4 font-bold text-[#1d3b2a]">
                                {{ $reservation->reservation_code }}
                            </td>
                            <td class="px-4 py-4">
                                <p class="font-semibold text-[#18221d]">{{ $reservation->guest->name }}</p>
                                <p class="text-xs text-[#748078]">{{ $reservation->guest->phone }}</p>
                            </td>
                            <td class="px-4 py-4">
                                <span class="font-medium text-[#18221d]">{{ $detail?->room?->roomType?->name ?? '-' }}</span>
                                <span class="block text-xs text-[#748078]">No. {{ $detail?->room?->room_number ?? '-' }}</span>
                            </td>
                            <td class="px-4 py-4">
                                <span class="font-medium text-[#18221d]">{{ $reservation->check_in->format('d M Y') }}</span>
                                <span class="block text-xs text-[#748078]">s/d {{ $reservation->check_out->format('d M Y') }}</span>
                            </td>
                            <td class="px-4 py-4 font-bold text-[#1d3b2a]">
                                Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                            </td>
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
                            <td class="px-4 py-4 text-right">
                                <a href="{{ route('admin.reservations.show', $reservation) }}" class="inline-flex items-center gap-1 rounded-full border border-[#dce2d8] bg-white px-4 py-1.5 text-xs font-bold text-[#1d3b2a] transition-all hover:bg-[#1d3b2a] hover:text-white group-hover:border-[#1d3b2a]">
                                    <span>Kelola</span>
                                    <span>↗</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center text-sm text-[#748078]">
                                Tidak ada data reservasi yang sesuai kriteria pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 border-t border-[#edf1eb] pt-4">
            {{ $reservations->links() }}
        </div>
    </div>
@endsection
