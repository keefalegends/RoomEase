<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $reservation->reservation_code }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 13px; color: #333; padding: 40px; }

        .header { display: table; width: 100%; margin-bottom: 35px; border-bottom: 3px solid #1d3b2a; padding-bottom: 20px; }
        .header-left { display: table-cell; vertical-align: middle; width: 60%; }
        .header-right { display: table-cell; vertical-align: middle; width: 40%; text-align: right; }
        .brand { font-size: 28px; font-weight: bold; color: #1d3b2a; letter-spacing: -1px; }
        .brand-sub { font-size: 11px; color: #748078; margin-top: 4px; }
        .invoice-title { font-size: 22px; font-weight: bold; color: #1d3b2a; }
        .invoice-code { font-size: 13px; color: #748078; margin-top: 4px; }

        .section { margin-bottom: 25px; }
        .section-title { font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 2px; color: #7c946a; margin-bottom: 10px; }

        .info-table { width: 100%; }
        .info-table td { padding: 5px 0; vertical-align: top; }
        .info-label { color: #748078; width: 140px; }
        .info-value { font-weight: 600; color: #1d3b2a; }

        .details-table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        .details-table th { background: #f3f5f0; text-align: left; padding: 10px 12px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #526057; border-bottom: 2px solid #dce2d8; }
        .details-table td { padding: 10px 12px; border-bottom: 1px solid #edf1eb; }

        .total-row td { border-top: 2px solid #1d3b2a; border-bottom: none; font-weight: bold; font-size: 15px; padding-top: 12px; color: #1d3b2a; }

        .status-badge { display: inline-block; padding: 4px 14px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .status-paid { background: #e8f5e9; color: #2e7d32; }
        .status-unpaid { background: #fff3e0; color: #ef6c00; }
        .status-confirmed { background: #e8f5e9; color: #2e7d32; }
        .status-pending { background: #fff3e0; color: #ef6c00; }
        .status-cancelled { background: #ffebee; color: #c62828; }
        .status-checked_in { background: #e3f2fd; color: #1565c0; }
        .status-checked_out { background: #f5f5f5; color: #616161; }

        .footer { margin-top: 40px; padding-top: 20px; border-top: 1px solid #e3e7df; text-align: center; font-size: 11px; color: #748078; }

        .two-col { display: table; width: 100%; }
        .two-col .col { display: table-cell; width: 50%; vertical-align: top; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <div class="brand">RoomEase</div>
            <div class="brand-sub">Hotel Reservation System</div>
        </div>
        <div class="header-right">
            <div class="invoice-title">INVOICE</div>
            <div class="invoice-code">{{ $reservation->reservation_code }}</div>
            <div class="invoice-code">{{ now()->format('d M Y') }}</div>
        </div>
    </div>

    <div class="two-col">
        <div class="col">
            <div class="section">
                <div class="section-title">Informasi Tamu</div>
                <table class="info-table">
                    <tr><td class="info-label">Nama</td><td class="info-value">{{ $reservation->guest->name }}</td></tr>
                    <tr><td class="info-label">Phone / WA</td><td class="info-value">{{ $reservation->guest->phone }}</td></tr>
                    <tr><td class="info-label">Email</td><td class="info-value">{{ $reservation->guest->email ?: '-' }}</td></tr>
                    <tr><td class="info-label">NIK</td><td class="info-value">{{ $reservation->guest->nik ?: '-' }}</td></tr>
                </table>
            </div>
        </div>
        <div class="col">
            <div class="section">
                <div class="section-title">Status</div>
                <table class="info-table">
                    <tr>
                        <td class="info-label">Reservasi</td>
                        <td><span class="status-badge status-{{ $reservation->status }}">{{ str_replace('_', ' ', $reservation->status) }}</span></td>
                    </tr>
                    <tr>
                        <td class="info-label">Pembayaran</td>
                        <td><span class="status-badge status-{{ $reservation->payment?->status ?? 'unpaid' }}">{{ $reservation->payment?->status ?? 'unpaid' }}</span></td>
                    </tr>
                    @if ($reservation->payment?->payment_method)
                    <tr>
                        <td class="info-label">Metode Bayar</td>
                        <td class="info-value">{{ ucwords(str_replace('-', ' ', $reservation->payment->payment_method)) }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Detail Pemesanan</div>
        <table class="details-table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Malam</th>
                    <th style="text-align:right">Harga/Malam</th>
                    <th style="text-align:right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $roomType->name }}</strong><br>
                        <span style="color:#748078; font-size:11px">Kamar {{ $room->room_number }}</span>
                    </td>
                    <td>{{ $reservation->check_in->format('d M Y') }}</td>
                    <td>{{ $reservation->check_out->format('d M Y') }}</td>
                    <td>{{ $nights }}</td>
                    <td style="text-align:right">Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}</td>
                    <td style="text-align:right">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="5">Total</td>
                    <td style="text-align:right">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p><strong>RoomEase Hotel</strong> — Jl. Bunga Raya No. 12, Bandung, Jawa Barat</p>
        <p style="margin-top:4px">Telp: 022-1234567 | Dokumen ini digenerate otomatis oleh sistem RoomEase.</p>
    </div>
</body>
</html>
