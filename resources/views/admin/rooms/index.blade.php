@extends('admin.layouts.app')

@section('title', 'Daftar Kamar — Admin')

@section('content')
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">ROOMS</p>
            <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">Daftar kamar</h1>
            <p class="mt-3 text-sm text-[#748078]">Kelola kamar fisik hotel — nomor, tipe, dan status ketersediaan.</p>
        </div>
        <a href="{{ route('admin.rooms.create') }}" class="inline-flex items-center gap-2 rounded-full bg-[#1d3b2a] px-6 py-3 text-xs font-bold text-white shadow-sm transition hover:bg-[#31583f]">
            <span class="text-[#d8f36b]">+</span> Tambah kamar
        </a>
    </div>

    <!-- Filter Card -->
    <div class="mb-6 rounded-3xl border border-[#e5ebe0] bg-white p-5 shadow-sm sm:p-6">
        <form method="get" class="grid gap-4 md:grid-cols-[1fr_1fr_auto]">
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-[#748078]">Tipe Kamar</label>
                <select name="room_type_id" class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                    <option value="">Semua tipe</option>
                    @foreach ($roomTypes as $type)
                        <option value="{{ $type->id }}" @selected(request('room_type_id') == $type->id)>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-[#748078]">Status</label>
                <select name="status" class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                    <option value="">Semua status</option>
                    @foreach (['available', 'occupied', 'maintenance'] as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="w-full rounded-full bg-[#1d3b2a] px-6 py-3.5 text-xs font-bold text-white transition hover:bg-[#31583f] md:w-auto">Filter</button>
                @if (request('room_type_id') || request('status'))
                    <a href="{{ route('admin.rooms.index') }}" class="rounded-full border border-[#dce2d8] bg-white px-4 py-3.5 text-xs font-bold text-[#748078] hover:text-[#1d3b2a]">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Room Table -->
    <div class="rounded-[2rem] border border-[#e5ebe0] bg-white p-6 shadow-sm sm:p-8">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-[#edf1eb] text-xs font-bold uppercase tracking-wider text-[#748078]">
                        <th class="px-4 py-3">No. Kamar</th>
                        <th class="px-4 py-3">Tipe</th>
                        <th class="px-4 py-3">Harga / Malam</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1f4ef]">
                    @forelse ($rooms as $room)
                        <tr class="group transition-colors hover:bg-[#fcfcfa]">
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="grid h-7 w-7 place-items-center rounded-lg bg-[#eef3ea] text-xs font-bold text-[#1d3b2a]">{{ $room->room_number }}</span>
                                    <span class="font-bold text-[#1d3b2a]">Kamar {{ $room->room_number }}</span>
                                </span>
                            </td>
                            <td class="px-4 py-4 font-medium text-[#18221d]">{{ $room->roomType->name }}</td>
                            <td class="px-4 py-4 font-semibold text-[#1d3b2a]">Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }}</td>
                            <td class="px-4 py-4">
                                @php $colors = ['available' => 'bg-green-50 text-green-800 border-green-200', 'occupied' => 'bg-amber-50 text-amber-800 border-amber-200', 'maintenance' => 'bg-red-50 text-red-800 border-red-200']; @endphp
                                <span class="rounded-full border px-3 py-1 text-[10px] font-bold uppercase tracking-wider {{ $colors[$room->status] ?? 'bg-gray-50' }}">{{ $room->status }}</span>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.rooms.edit', $room) }}" class="rounded-full border border-[#dce2d8] bg-white px-3 py-1.5 text-xs font-bold text-[#526057] transition hover:border-[#1d3b2a] hover:text-[#1d3b2a]">Edit</a>
                                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="post" onsubmit="return confirm('Yakin hapus kamar {{ $room->room_number }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="rounded-full border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 transition hover:bg-red-600 hover:text-white">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-sm text-[#748078]">Belum ada kamar terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6 border-t border-[#edf1eb] pt-4">{{ $rooms->links() }}</div>
    </div>
@endsection
