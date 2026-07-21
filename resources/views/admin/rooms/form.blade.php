@extends('admin.layouts.app')

@section('title', isset($room) ? 'Edit Kamar — Admin' : 'Tambah Kamar — Admin')

@section('content')
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">ROOMS</p>
            <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">{{ isset($room) ? "Edit kamar #{$room->room_number}" : 'Tambah kamar baru' }}</h1>
            <p class="mt-3 text-sm text-[#748078]">{{ isset($room) ? 'Update data fisik kamar hotel.' : 'Daftarkan kamar baru ke dalam sistem.' }}</p>
        </div>
        <a href="{{ route('admin.rooms.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#dce2d8] bg-white px-5 py-3 text-xs font-bold text-[#526057] transition hover:border-[#1d3b2a] hover:text-[#1d3b2a]">← Kembali ke daftar</a>
    </div>

    <div class="mx-auto max-w-2xl rounded-[2rem] border border-[#e5ebe0] bg-white p-8 shadow-sm sm:p-10">
        <form action="{{ isset($room) ? route('admin.rooms.update', $room) : route('admin.rooms.store') }}" method="post" class="grid gap-6">
            @csrf
            @isset($room) @method('PUT') @endisset

            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#748078]">Nomor Kamar</label>
                <input type="text" name="room_number" value="{{ old('room_number', $room->room_number ?? '') }}" required
                    class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3.5 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]" placeholder="misal: 501">
                @error('room_number')<span class="mt-1 block text-xs font-medium text-red-600">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#748078]">Tipe Kamar</label>
                <select name="room_type_id" required
                    class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3.5 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                    <option value="">Pilih tipe kamar</option>
                    @foreach ($roomTypes as $type)
                        <option value="{{ $type->id }}" @selected(old('room_type_id', $room->room_type_id ?? '') == $type->id)>{{ $type->name }} — Rp {{ number_format($type->price_per_night, 0, ',', '.') }}/malam</option>
                    @endforeach
                </select>
                @error('room_type_id')<span class="mt-1 block text-xs font-medium text-red-600">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#748078]">Status Kamar</label>
                <select name="status" required
                    class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3.5 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                    @foreach (['available' => 'Available', 'occupied' => 'Occupied', 'maintenance' => 'Maintenance'] as $val => $label)
                        <option value="{{ $val }}" @selected(old('status', $room->status ?? 'available') === $val)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status')<span class="mt-1 block text-xs font-medium text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="mt-4 flex items-center gap-4 border-t border-[#edf1eb] pt-6">
                <button type="submit" class="rounded-full bg-[#1d3b2a] px-8 py-3.5 text-xs font-bold text-white transition hover:bg-[#31583f]">{{ isset($room) ? 'Simpan perubahan' : 'Tambah kamar' }}</button>
                <a href="{{ route('admin.rooms.index') }}" class="text-xs font-bold text-[#748078] hover:text-[#1d3b2a]">Batalkan</a>
            </div>
        </form>
    </div>
@endsection
