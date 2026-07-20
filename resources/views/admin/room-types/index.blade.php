@extends('admin.layouts.app')

@section('title', 'Tipe Kamar')

@section('content')
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#7c946a]">Room Types</p>
            <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">Tipe kamar</h1>
            <p class="mt-3 text-sm text-[#748078]">Kelola kategori kamar beserta harga dan kapasitasnya.</p>
        </div>
        <a href="{{ route('admin.room-types.create') }}" class="inline-flex items-center gap-2 rounded-full bg-[#1d3b2a] px-6 py-3 text-sm font-semibold text-white hover:bg-[#31583f]">+ Tambah tipe kamar</a>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-[#edf1eb] text-[#748078]">
                        <th class="px-4 py-3 font-medium">Nama</th>
                        <th class="px-4 py-3 font-medium">Deskripsi</th>
                        <th class="px-4 py-3 font-medium">Harga / Malam</th>
                        <th class="px-4 py-3 font-medium">Kapasitas</th>
                        <th class="px-4 py-3 font-medium">Jumlah Kamar</th>
                        <th class="px-4 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roomTypes as $type)
                        <tr class="border-b border-[#f1f4ef]">
                            <td class="px-4 py-4 font-semibold">{{ $type->name }}</td>
                            <td class="px-4 py-4 text-[#748078]">{{ Str::limit($type->description, 50) }}</td>
                            <td class="px-4 py-4">Rp {{ number_format($type->price_per_night, 0, ',', '.') }}</td>
                            <td class="px-4 py-4">{{ $type->capacity }} tamu</td>
                            <td class="px-4 py-4">{{ $type->rooms_count }} kamar</td>
                            <td class="px-4 py-4 flex gap-3">
                                <a href="{{ route('admin.room-types.edit', $type) }}" class="font-medium text-[#1d3b2a] hover:underline">Edit</a>
                                <form action="{{ route('admin.room-types.destroy', $type) }}" method="post" onsubmit="return confirm('Yakin hapus tipe kamar ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-6 text-center text-[#748078]">Belum ada tipe kamar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
