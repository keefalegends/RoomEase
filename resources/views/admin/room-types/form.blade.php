@extends('admin.layouts.app')

@section('title', isset($roomType) ? 'Edit Tipe Kamar' : 'Tambah Tipe Kamar')

@section('content')
    <div class="mb-8">
        <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#7c946a]">Room Types</p>
        <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">{{ isset($roomType) ? 'Edit tipe kamar' : 'Tambah tipe kamar baru' }}</h1>
    </div>

    <div class="mx-auto max-w-2xl rounded-3xl bg-white p-8 shadow-sm">
        <form action="{{ isset($roomType) ? route('admin.room-types.update', $roomType) : route('admin.room-types.store') }}" method="post" class="grid gap-5">
            @csrf
            @isset($roomType) @method('PUT') @endisset

            <div>
                <label class="mb-2 block text-sm font-medium text-[#526057]">Nama Tipe Kamar</label>
                <input type="text" name="name" value="{{ old('name', $roomType->name ?? '') }}" required
                    class="w-full rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]" placeholder="misal: The Essential">
                @error('name')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-[#526057]">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]" placeholder="Deskripsi singkat tipe kamar">{{ old('description', $roomType->description ?? '') }}</textarea>
                @error('description')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-[#526057]">Harga per Malam (Rp)</label>
                    <input type="number" name="price_per_night" value="{{ old('price_per_night', $roomType->price_per_night ?? '') }}" required min="0"
                        class="w-full rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]" placeholder="850000">
                    @error('price_per_night')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-[#526057]">Kapasitas (tamu)</label>
                    <input type="number" name="capacity" value="{{ old('capacity', $roomType->capacity ?? '') }}" required min="1" max="20"
                        class="w-full rounded-xl border border-[#dce2d8] px-4 py-3 outline-none focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]" placeholder="2">
                    @error('capacity')<span class="mt-1 block text-sm text-red-600">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mt-4 flex items-center gap-4">
                <button type="submit" class="rounded-full bg-[#1d3b2a] px-8 py-3 font-semibold text-white hover:bg-[#31583f]">{{ isset($roomType) ? 'Simpan perubahan' : 'Tambah tipe kamar' }}</button>
                <a href="{{ route('admin.room-types.index') }}" class="text-sm text-[#748078] hover:text-[#1d3b2a]">Batal</a>
            </div>
        </form>
    </div>
@endsection
