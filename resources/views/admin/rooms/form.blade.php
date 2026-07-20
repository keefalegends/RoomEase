@extends('admin.layouts.app')

@section('title', isset($room) ? 'Edit Kamar' : 'Tambah Kamar')

@section('content')
    <div class="mb-8">
        <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#7c946a]">Rooms</p>
        <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">{{ isset($room) ? "Edit kamar {$room->room_number}" : 'Tambah kamar baru' }}</h1>
    </div>

    <div class="mx-auto max-w-2xl rounded-3xl bg-white p-8 shadow-sm">
        <form action="{{ isset($room) ? route('admin.rooms.update', $room) : route('admin.rooms.store') }}" method="post" class="grid gap-5">
            @csrf
            @isset($room) @method('PUT') @endisset

            <div>
                <label class="mb-2 block text-sm font-medium text-[#526057]">Nomor Kamar</label>
                <input type="text" name="room_number" value="{{ old('room_number', $room->room_number ?? '') }}" required
                    class="w-full rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]" placeholder="misal: 501">
                @error('room_number')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-[#526057]">Tipe Kamar</label>
                <select name="room_type_id" required
                    class="w-full rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                    <option value="">Pilih tipe kamar</option>
                    @foreach ($roomTypes as $type)
                        <option value="{{ $type->id }}" @selected(old('room_type_id', $room->room_type_id ?? '') == $type->id)>{{ $type->name }} — Rp {{ number_format($type->price_per_night, 0, ',', '.') }}/malam</option>
                    @endforeach
                </select>
                @error('room_type_id')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-[#526057]">Status</label>
                <select name="status" required
                    class="w-full rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                    @foreach (['available' => 'Available', 'occupied' => 'Occupied', 'maintenance' => 'Maintenance'] as $val => $label)
                        <option value="{{ $val }}" @selected(old('status', $room->status ?? 'available') === $val)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="mt-4 flex items-center gap-4">
                <button type="submit" class="rounded-full bg-[#1d3b2a] px-8 py-3 font-semibold text-white hover:bg-[#31583f]">{{ isset($room) ? 'Simpan perubahan' : 'Tambah kamar' }}</button>
                <a href="{{ route('admin.rooms.index') }}" class="text-sm text-[#748078] hover:text-[#1d3b2a]">Batal</a>
            </div>
        </form>
    </div>
@endsection
