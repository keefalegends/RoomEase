@extends('admin.layouts.app')

@section('title', isset($roomType) ? 'Edit Tipe Kamar — Admin' : 'Tambah Tipe Kamar — Admin')

@section('content')
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">ROOM TYPES</p>
            <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">{{ isset($roomType) ? 'Edit tipe kamar' : 'Tambah tipe kamar baru' }}</h1>
            <p class="mt-3 text-sm text-[#748078]">{{ isset($roomType) ? 'Update kategori kamar yang sudah ada.' : 'Buat kategori kamar baru dengan harga dan kapasitas.' }}</p>
        </div>
        <a href="{{ route('admin.room-types.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#dce2d8] bg-white px-5 py-3 text-xs font-bold text-[#526057] transition hover:border-[#1d3b2a] hover:text-[#1d3b2a]">← Kembali ke daftar</a>
    </div>

    <div class="mx-auto max-w-2xl rounded-[2rem] border border-[#e5ebe0] bg-white p-8 shadow-sm sm:p-10">
        <form action="{{ isset($roomType) ? route('admin.room-types.update', $roomType) : route('admin.room-types.store') }}" method="post" class="grid gap-6">
            @csrf
            @isset($roomType) @method('PUT') @endisset

            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#748078]">Nama Tipe Kamar</label>
                <input type="text" name="name" value="{{ old('name', $roomType->name ?? '') }}" required
                    class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3.5 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]" placeholder="misal: The Essential">
                @error('name')<span class="mt-1 block text-xs font-medium text-red-600">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#748078]">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3.5 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]" placeholder="Deskripsi singkat tipe kamar">{{ old('description', $roomType->description ?? '') }}</textarea>
                @error('description')<span class="mt-1 block text-xs font-medium text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#748078]">Harga per Malam (Rp)</label>
                    <input type="number" name="price_per_night" value="{{ old('price_per_night', $roomType->price_per_night ?? '') }}" required min="0"
                        class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3.5 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]" placeholder="850000">
                    @error('price_per_night')<span class="mt-1 block text-xs font-medium text-red-600">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-[#748078]">Kapasitas (tamu)</label>
                    <input type="number" name="capacity" value="{{ old('capacity', $roomType->capacity ?? '') }}" required min="1" max="20"
                        class="w-full rounded-2xl border border-[#dce2d8] px-4 py-3.5 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]" placeholder="2">
                    @error('capacity')<span class="mt-1 block text-xs font-medium text-red-600">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mt-4 flex items-center gap-4 border-t border-[#edf1eb] pt-6">
                <button type="submit" class="rounded-full bg-[#1d3b2a] px-8 py-3.5 text-xs font-bold text-white transition hover:bg-[#31583f]">{{ isset($roomType) ? 'Simpan perubahan' : 'Tambah tipe kamar' }}</button>
                <a href="{{ route('admin.room-types.index') }}" class="text-xs font-bold text-[#748078] hover:text-[#1d3b2a]">Batalkan</a>
            </div>
        </form>
    </div>
@endsection
