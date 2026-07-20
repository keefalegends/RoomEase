@extends('admin.layouts.app')

@section('title', 'Manajemen Reservasi')

@section('content')
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#7c946a]">Reservations</p>
            <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">Manajemen reservasi</h1>
            <p class="mt-3 max-w-2xl text-sm leading-6 text-[#748078]">Lihat, cari, dan kelola seluruh booking tamu di RoomEase.</p>
        </div>
    </div>

    <div class="mb-6 rounded-3xl bg-white p-5 shadow-sm">
        <form method="get" class="grid gap-4 md:grid-cols-[1fr_220px_auto]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode booking / nama / no HP"
                class="rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
            <select name="status" class="rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                <option value="">Semua status</option>
                @foreach (['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucwords(str_replace('_', ' ', $status)) }}</option>
                @endforeach
            </select>
            <button type="submit" class="rounded-full bg-[#1d3b2a] px-6 py-3 font-semibold text-white hover:bg-[#31583f]">Filter</button>
        </form>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-[#edf1eb] text-[#748078]">
                        <th class="px-4 py-3 font-medium">Kode</th>
                        <th class="px-4 py-3 font-medium">Tamu</th>
                        <th class="px-4 py-3 font-medium">Kamar</th>
                        <th class="px-4 py-3 font-medium">Check-in</th>
                        <th class="px-4 py-3 font-medium">Total</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservations as $reservation)
                        @php $detail = $reservation->reservationDetails->first(); @endphp
                        <tr class="border-b border-[#f1f4ef]">
                            <td class="px-4 py-4 font-semibold">{{ $reservation->reservation_code }}</td>
                            <td class="px-4 py-4">
                                <p class="font-medium">{{ $reservation->guest->name }}</p>
                                <p class="text-xs text-[#748078]">{{ $reservation->guest->phone }}</p>
                            </td>
                            <td class="px-4 py-4">{{ $detail?->room?->roomType?->name ?? '-' }} / {{ $detail?->room?->room_number ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $reservation->check_in->format('d M Y') }}</td>
                            <td class="px-4 py-4">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-4"><span class="rounded-full bg-[#f3f5f0] px-3 py-1 text-xs font-semibold uppercase">{{ str_replace('_', ' ', $reservation->status) }}</span></td>
                            <td class="px-4 py-4"><a href="{{ route('admin.reservations.show', $reservation) }}" class="font-medium text-[#1d3b2a] hover:underline">Detail</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-4 py-6 text-center text-[#748078]">Belum ada data reservasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $reservations->links() }}</div>
    </div>
@endsection
