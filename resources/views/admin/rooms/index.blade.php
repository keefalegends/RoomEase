@extends('admin.layouts.app')

@section('title', 'Daftar Kamar')

@section('content')
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#7c946a]">Rooms</p>
            <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">Daftar kamar</h1>
            <p class="mt-3 text-sm text-[#748078]">Kelola kamar fisik hotel — nomor, tipe, dan status ketersediaan.</p>
        </div>
        <a href="{{ route('admin.rooms.create') }}" class="inline-flex items-center gap-2 rounded-full bg-[#1d3b2a] px-6 py-3 text-sm font-semibold text-white hover:bg-[#31583f]">+ Tambah kamar</a>
    </div>

    <div class="mb-6 rounded-3xl bg-white p-5 shadow-sm">
        <form method="get" class="grid gap-4 md:grid-cols-[1fr_1fr_auto]">
            <select name="room_type_id" class="rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                <option value="">Semua tipe</option>
                @foreach ($roomTypes as $type)
                    <option value="{{ $type->id }}" @selected(request('room_type_id') == $type->id)>{{ $type->name }}</option>
                @endforeach
            </select>
            <select name="status" class="rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                <option value="">Semua status</option>
                @foreach (['available', 'occupied', 'maintenance'] as $s)
                    <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
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
                        <th class="px-4 py-3 font-medium">No. Kamar</th>
                        <th class="px-4 py-3 font-medium">Tipe</th>
                        <th class="px-4 py-3 font-medium">Harga / Malam</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rooms as $room)
                        <tr class="border-b border-[#f1f4ef]">
                            <td class="px-4 py-4 font-semibold">{{ $room->room_number }}</td>
                            <td class="px-4 py-4">{{ $room->roomType->name }}</td>
                            <td class="px-4 py-4">Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }}</td>
                            <td class="px-4 py-4">
                                @php $colors = ['available' => 'bg-green-50 text-green-800', 'occupied' => 'bg-amber-50 text-amber-800', 'maintenance' => 'bg-red-50 text-red-800']; @endphp
                                <span class="rounded-full px-3 py-1 text-xs font-semibold uppercase {{ $colors[$room->status] ?? 'bg-gray-50' }}">{{ $room->status }}</span>
                            </td>
                            <td class="px-4 py-4 flex gap-3">
                                <a href="{{ route('admin.rooms.edit', $room) }}" class="font-medium text-[#1d3b2a] hover:underline">Edit</a>
                                <form action="{{ route('admin.rooms.destroy', $room) }}" method="post" onsubmit="return confirm('Yakin hapus kamar {{ $room->room_number }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-6 text-center text-[#748078]">Belum ada kamar terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $rooms->links() }}</div>
    </div>
@endsection
