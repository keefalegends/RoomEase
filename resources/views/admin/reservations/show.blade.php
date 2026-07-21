@extends('admin.layouts.app')

@section('title', 'Detail Reservasi #' . $reservation->reservation_code . ' — Admin')

@section('content')
    @php $detail = $reservation->reservationDetails->first(); @endphp

    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">RESERVATION DETAIL</p>
            <div class="mt-2 flex flex-wrap items-center gap-3">
                <h1 class="text-4xl font-semibold tracking-[-0.05em] text-[#1d3b2a]">Booking #{{ $reservation->reservation_code }}</h1>
                @php
                    $statusColors = [
                        'pending' => 'bg-amber-50 text-amber-800 border-amber-200',
                        'confirmed' => 'bg-green-50 text-green-800 border-green-200',
                        'checked_in' => 'bg-blue-50 text-blue-800 border-blue-200',
                        'checked_out' => 'bg-[#f3f5f0] text-[#526057] border-[#dce2d8]',
                        'cancelled' => 'bg-red-50 text-red-800 border-red-200',
                    ];
                @endphp
                <span class="rounded-full border px-3.5 py-1 text-[10px] font-bold uppercase tracking-wider {{ $statusColors[$reservation->status] ?? 'bg-gray-50' }}">
                    {{ str_replace('_', ' ', $reservation->status) }}
                </span>
            </div>
            <p class="mt-2 text-sm text-[#748078]">Update status check-in/check-out dan verifikasi pembayaran tamu.</p>
        </div>
        <a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#dce2d8] bg-white px-5 py-3 text-xs font-bold text-[#526057] transition-all hover:border-[#1d3b2a] hover:text-[#1d3b2a]">
            <span>← Kembali ke daftar</span>
        </a>
    </div>

    <!-- Visual Booking Status Workflow -->
    <div class="mb-8 rounded-3xl border border-[#e5ebe0] bg-white p-6 shadow-sm">
        <h3 class="mb-4 text-xs font-bold uppercase tracking-widest text-[#748078]">Alur Status Booking</h3>
        <div class="relative flex flex-col justify-between gap-4 sm:flex-row">
            @php
                $steps = [
                    'pending' => ['label' => 'Pending', 'desc' => 'Menunggu Pembayaran'],
                    'confirmed' => ['label' => 'Confirmed', 'desc' => 'Pembayaran Valid'],
                    'checked_in' => ['label' => 'Checked In', 'desc' => 'Tamu Menginap'],
                    'checked_out' => ['label' => 'Checked Out', 'desc' => 'Tamu Selesai']
                ];
                $activeFound = false;
                $currentStatus = $reservation->status;
            @endphp
            @foreach ($steps as $key => $step)
                @php
                    $isCurrent = $currentStatus === $key;
                    $isCompleted = false;
                    if ($currentStatus === 'cancelled') {
                        $isCompleted = false;
                    } else {
                        // Logika step done
                        if ($currentStatus === 'checked_out') $isCompleted = true;
                        elseif ($currentStatus === 'checked_in' && in_array($key, ['pending', 'confirmed'])) $isCompleted = true;
                        elseif ($currentStatus === 'confirmed' && $key === 'pending') $isCompleted = true;
                    }
                @endphp
                <div class="flex flex-1 items-center gap-3">
                    <span class="grid h-8 w-8 place-items-center rounded-full text-xs font-bold transition-all {{ $isCurrent ? 'bg-[#1d3b2a] text-[#d8f36b] ring-4 ring-[#1d3b2a]/10' : ($isCompleted ? 'bg-emerald-100 text-emerald-800' : 'bg-[#f0f3ed] text-[#748078]') }}">
                        @if ($isCompleted) ✓ @else {{ $loop->iteration }} @endif
                    </span>
                    <div>
                        <p class="text-xs font-bold text-[#18221d]">{{ $step['label'] }}</p>
                        <p class="text-[10px] text-[#748078]">{{ $step['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
        <!-- Customer & Stay Info -->
        <div class="space-y-6">
            <!-- Guest info -->
            <div class="rounded-3xl border border-[#e5ebe0] bg-white p-6 shadow-sm sm:p-8">
                <h2 class="text-xl font-bold tracking-tight text-[#1d3b2a]">Informasi Tamu</h2>
                <div class="mt-6 grid gap-6 sm:grid-cols-2">
                    <div class="rounded-2xl bg-[#f7f7f2] p-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#748078]">Nama Lengkap</span>
                        <p class="mt-1 text-sm font-semibold text-[#1d3b2a]">{{ $reservation->guest->name }}</p>
                    </div>
                    <div class="rounded-2xl bg-[#f7f7f2] p-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#748078]">WhatsApp / Phone</span>
                        <p class="mt-1 text-sm font-semibold text-[#1d3b2a]">{{ $reservation->guest->phone }}</p>
                    </div>
                    <div class="rounded-2xl bg-[#f7f7f2] p-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#748078]">Alamat Email</span>
                        <p class="mt-1 text-sm font-semibold text-[#1d3b2a]">{{ $reservation->guest->email ?: '-' }}</p>
                    </div>
                    <div class="rounded-2xl bg-[#f7f7f2] p-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#748078]">NIK / ID Card</span>
                        <p class="mt-1 text-sm font-semibold text-[#1d3b2a]">{{ $reservation->guest->nik ?: '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Booking Info -->
            <div class="rounded-3xl border border-[#e5ebe0] bg-white p-6 shadow-sm sm:p-8">
                <h2 class="text-xl font-bold tracking-tight text-[#1d3b2a]">Detail Reservasi & Kamar</h2>
                <div class="mt-6 grid gap-6 sm:grid-cols-2">
                    <div class="rounded-2xl bg-[#f7f7f2] p-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#748078]">Tipe Kamar</span>
                        <p class="mt-1 text-sm font-semibold text-[#1d3b2a]">{{ $detail?->room?->roomType?->name ?? '-' }}</p>
                    </div>
                    <div class="rounded-2xl bg-[#f7f7f2] p-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#748078]">Nomor Kamar Fisik</span>
                        <p class="mt-1 text-sm font-semibold text-[#1d3b2a]">Kamar {{ $detail?->room?->room_number ?? '-' }}</p>
                    </div>
                    <div class="rounded-2xl bg-[#f7f7f2] p-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#748078]">Tanggal Check-In</span>
                        <p class="mt-1 text-sm font-semibold text-[#1d3b2a]">{{ $reservation->check_in->format('d M Y') }}</p>
                    </div>
                    <div class="rounded-2xl bg-[#f7f7f2] p-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#748078]">Tanggal Check-Out</span>
                        <p class="mt-1 text-sm font-semibold text-[#1d3b2a]">{{ $reservation->check_out->format('d M Y') }}</p>
                    </div>
                    <div class="rounded-2xl bg-[#f7f7f2] p-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#748078]">Durasi Menginap</span>
                        <p class="mt-1 text-sm font-semibold text-[#1d3b2a]">{{ $nights }} malam</p>
                    </div>
                    <div class="rounded-2xl bg-[#f7f7f2] p-4 border border-[#e5ebe0]">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#7c946a]">Total Tagihan</span>
                        <p class="mt-1 text-base font-bold text-[#1d3b2a]">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action & Payment Controls -->
        <div class="space-y-6">
            <!-- Payment Info -->
            <div class="rounded-3xl border border-[#e5ebe0] bg-white p-6 shadow-sm sm:p-8">
                <h2 class="text-xl font-bold tracking-tight text-[#1d3b2a]">Informasi Pembayaran</h2>
                <div class="mt-5 space-y-4">
                    <div class="flex justify-between border-b border-[#edf1eb] pb-3 text-sm">
                        <span class="text-[#748078]">Metode Bayar</span>
                        <span class="font-bold text-[#1d3b2a]">{{ $reservation->payment?->payment_method ? ucwords(str_replace('-', ' ', $reservation->payment->payment_method)) : '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-[#edf1eb] pb-3 text-sm">
                        <span class="text-[#748078]">Status Pembayaran</span>
                        <span class="rounded bg-emerald-50 px-2 py-0.5 text-xs font-bold text-emerald-800 uppercase">{{ $reservation->payment?->status ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#748078]">Tanggal Bayar</span>
                        <span class="font-semibold text-[#1d3b2a]">{{ $reservation->payment?->payment_date?->format('d M Y H:i') ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Update Status Form -->
            <div class="rounded-3xl border border-amber-100 bg-[#fbfbfa] p-6 shadow-sm sm:p-8">
                <h2 class="text-xl font-bold tracking-tight text-[#1d3b2a]">Aksi & Status</h2>
                <p class="mt-2 text-xs text-[#748078]">Ubah status untuk meng-update ketersediaan kamar hotel.</p>

                <form action="{{ route('admin.reservations.update-status', $reservation) }}" method="post" class="mt-6 grid gap-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[#748078]">Ubah Status Reservasi</label>
                        <select name="status" class="w-full rounded-2xl border border-[#dce2d8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#1d3b2a] focus:ring-1 focus:ring-[#1d3b2a]">
                            @foreach (['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'] as $status)
                                <option value="{{ $status }}" @selected($reservation->status === $status)>{{ ucwords(str_replace('_', ' ', $status)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full rounded-full bg-[#1d3b2a] px-6 py-3.5 text-xs font-bold text-white transition hover:bg-[#31583f]">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
