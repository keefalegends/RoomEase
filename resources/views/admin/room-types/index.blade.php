@extends('admin.layouts.app')

@section('title', 'Tipe Kamar — Admin')

@section('content')
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">ROOM TYPES</p>
            <h1 class="mt-2 text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">Tipe kamar</h1>
            <p class="mt-3 text-sm text-[#748078]">Kelola kategori kamar beserta harga dan kapasitasnya.</p>
        </div>
        <a href="{{ route('admin.room-types.create') }}" class="inline-flex items-center gap-2 rounded-full bg-[#1d3b2a] px-6 py-3 text-xs font-bold text-white shadow-sm transition hover:bg-[#31583f]">
            <span class="text-[#d8f36b]">+</span> Tambah tipe kamar
        </a>
    </div>

    <div class="rounded-[2rem] border border-[#e5ebe0] bg-white p-6 shadow-sm sm:p-8">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-[#edf1eb] text-xs font-bold uppercase tracking-wider text-[#748078]">
                        <th class="px-4 py-3">Nama Tipe</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Harga / Malam</th>
                        <th class="px-4 py-3">Kapasitas</th>
                        <th class="px-4 py-3">Jumlah Kamar</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1f4ef]">
                    @forelse ($roomTypes as $type)
                        <tr class="group transition-colors hover:bg-[#fcfcfa]">
                            <td class="px-4 py-4">
                                <span class="font-bold text-[#1d3b2a]">{{ $type->name }}</span>
                            </td>
                            <td class="px-4 py-4 max-w-[200px] truncate text-[#748078]">{{ Str::limit($type->description, 50) }}</td>
                            <td class="px-4 py-4 font-bold text-[#1d3b2a]">Rp {{ number_format($type->price_per_night, 0, ',', '.') }}</td>
                            <td class="px-4 py-4">
                                <span class="rounded-full bg-[#eef3ea] px-3 py-1 text-xs font-semibold text-[#526057]">{{ $type->capacity }} tamu</span>
                            </td>
                            <td class="px-4 py-4">
                                <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-800">{{ $type->rooms_count }} kamar</span>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.room-types.edit', $type) }}" class="rounded-full border border-[#dce2d8] bg-white px-3 py-1.5 text-xs font-bold text-[#526057] transition hover:border-[#1d3b2a] hover:text-[#1d3b2a]">Edit</a>
                                    <form action="{{ route('admin.room-types.destroy', $type) }}" method="post" onsubmit="return confirm('Yakin hapus tipe kamar ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="rounded-full border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 transition hover:bg-red-600 hover:text-white">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-10 text-center text-sm text-[#748078]">Belum ada tipe kamar terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
