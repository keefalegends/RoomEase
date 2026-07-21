<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\RoomType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatAssistantController extends Controller
{
    public function reply(Request $request): JsonResponse
    {
        $message = trim((string) $request->input('message', ''));
        if ($message === '') {
            return response()->json([
                'reply' => 'Halo! Ada yang bisa EaseBot bantu seputar reservasi, kamar, atau fasilitas RoomEase?'
            ]);
        }

        $lower = Str::lower($message);

        // 1. Check if user provided or asked about a reservation code (Pattern: RE-YYYYMMDD-XXXXX or RE-XXXXX)
        if (preg_match('/RE-[A-Z0-9-]+/i', $message, $matches)) {
            $code = strtoupper($matches[0]);
            $reservation = Reservation::with(['guest', 'reservationDetails.room.roomType', 'payment'])
                ->where('reservation_code', $code)
                ->first();

            if ($reservation) {
                $guestName = $reservation->guest ? $reservation->guest->name : 'Tamu';
                $detail = $reservation->reservationDetails->first();
                $roomName = $detail?->room?->roomType?->name ?? 'Kamar Hotel';
                $roomNumber = $detail?->room?->room_number ?? 'Akan diinfokan saat check-in';
                $status = ucfirst($reservation->status);
                $paymentStatus = $reservation->payment ? ucfirst($reservation->payment->status) : 'Unpaid';
                $checkIn = $reservation->check_in->format('d M Y');
                $checkOut = $reservation->check_out->format('d M Y');
                $nights = max(1, $reservation->check_in->diffInDays($reservation->check_out));

                $reply = "🔍 **Detail Reservasi {$code}**\n\n"
                    . "👤 **Tamu**: {$guestName}\n"
                    . "🛏️ **Tipe Kamar**: {$roomName} (No. {$roomNumber})\n"
                    . "📅 **Jadwal**: {$checkIn} s/d {$checkOut} ({$nights} malam)\n"
                    . "📌 **Status Booking**: `{$status}`\n"
                    . "💳 **Pembayaran**: `{$paymentStatus}` (Rp " . number_format($reservation->total_price, 0, ',', '.') . ")\n\n"
                    . "Kamu juga bisa cek detail lengkap atau cetak invoice PDF melalui menu **Cek Reservasi** di website ya!";

                return response()->json(['reply' => $reply]);
            } else {
                return response()->json([
                    'reply' => "Maaf, kode reservasi `{$code}` tidak ditemukan di sistem kami. Mohon periksa kembali kode booking kamu atau gunakan fitur Cek Reservasi."
                ]);
            }
        }

        // 2. Keyword check: Kamar / Room / Ketersediaan / Harga
        if (Str::contains($lower, ['kamar', 'room', 'kosong', 'tersedia', 'available', 'harga', 'price', 'tipe', 'suite', 'deluxe'])) {
            $roomTypes = RoomType::withCount(['rooms as available_rooms_count' => function ($query) {
                $query->where('status', 'available');
            }])->get();

            if ($roomTypes->isEmpty()) {
                return response()->json([
                    'reply' => "Saat ini kami sedang menyiapkan tipe-tipe kamar terbaik untuk kamu. Silakan pantau terus halaman **Our stays** ya!"
                ]);
            }

            $reply = "🏨 **Ketersediaan & Pilihan Kamar RoomEase Saat Ini:**\n\n";
            foreach ($roomTypes as $rt) {
                $statusKamar = $rt->available_rooms_count > 0 
                    ? "✅ Ready ({$rt->available_rooms_count} kamar kosong)" 
                    : "❌ Sold Out";

                $priceFmt = "Rp " . number_format($rt->price_per_night, 0, ',', '.');
                $reply .= "• **{$rt->name}** ({$rt->capacity} tamu)\n"
                    . "  Harga: `{$priceFmt}/malam` | Status: {$statusKamar}\n"
                    . "  _{$rt->description}_\n\n";
            }
            $reply .= "Ingin memesan? Klik menu **All rooms** di atas untuk langsung memilih tanggal menginap ya! ✨";

            return response()->json(['reply' => $reply]);
        }

        // 3. Keyword check: Cek Reservasi / Booking
        if (Str::contains($lower, ['cek', 'status', 'booking', 'reservasi', 'invoice', 'struk', 'bukti'])) {
            return response()->json([
                'reply' => "Untuk mengecek status reservasi atau download invoice PDF, kamu bisa sebutkan **Kode Booking** kamu di sini (contoh: `RE-20260721-ABCD1`), atau buka halaman **Cek Reservasi** di menu navigasi atas."
            ]);
        }

        // 4. Keyword check: Jam Check-in / Check-out
        if (Str::contains($lower, ['jam', 'waktu', 'checkin', 'check in', 'checkout', 'check out', 'pukul'])) {
            return response()->json([
                'reply' => "⏰ **Waktu Operasional Check-In & Check-Out:**\n\n"
                    . "• **Check-in**: Mulai pukul **14:00 WIB**\n"
                    . "• **Check-out**: Maksimal pukul **12:00 WIB**\n\n"
                    . "Jika kamu butuh early check-in atau late check-out, silakan hubungi tim resepsionis kami saat kedatangan ya!"
            ]);
        }

        // 5. Keyword check: Fasilitas / Sarapan / Wifi / Parkir / Lokasi
        if (Str::contains($lower, ['fasilitas', 'sarapan', 'breakfast', 'makan', 'wifi', 'internet', 'parkir', 'kolam', 'alamat', 'lokasi', 'tempat'])) {
            return response()->json([
                'reply' => "🌿 **Fasilitas Unggulan di RoomEase:**\n\n"
                    . "☕ **Morning Coffee & Breakfast**: Kopi segar dan sarapan lokal setiap pagi.\n"
                    . "📶 **High-Speed Wi-Fi**: Koneksi internet cepat di seluruh area kamar & lounge.\n"
                    . "🛏️ **Premium Linens**: Kasur king-size dengan linen berkualitas dan tirai blackout.\n"
                    . "🚗 **Free Parking**: Area parkir aman untuk kendaraan tamu.\n\n"
                    . "📍 **Lokasi Kami**: Suasana tenang di tengah kawasan strategis kota."
            ]);
        }

        // 6. Keyword check: Cara Bayar / Metode Pembayaran
        if (Str::contains($lower, ['bayar', 'pembayaran', 'payment', 'transfer', 'qris', 'ewallet', 'cash', 'tunai'])) {
            return response()->json([
                'reply' => "💳 **Metode Pembayaran yang Didukung:**\n\n"
                    . "1. **Cash / Tunai** (Bayar langsung di resepsionis saat check-in)\n"
                    . "2. **Bank Transfer** (BCA, Mandiri, BNI, BRI)\n"
                    . "3. **E-Wallet & QRIS** (GoPay, OVO, ShopeePay)\n\n"
                    . "Setelah mengisi form booking, kamu akan diarahkan ke halaman simulasi pembayaran yang sangat mudah!"
            ]);
        }

        // 7. Greeting & General Fallback
        if (Str::contains($lower, ['halo', 'hai', 'hello', 'hi', 'pagi', 'siang', 'malam', 'sore', 'assalamualaikum', 'oi', 'bro', 'min'])) {
            return response()->json([
                'reply' => "Halo! Selamat datang di **RoomEase AI Customer Service** 🤖🌿\n\nAda yang bisa saya bantu hari ini? Kamu bisa tanya tentang:\n"
                    . "1. 🛏️ Ketersediaan & harga kamar\n"
                    . "2. 🔍 Cek status booking (sebutkan kode reservasi)\n"
                    . "3. ⏰ Jam check-in & check-out\n"
                    . "4. ☕ Fasilitas hotel & sarapan"
            ]);
        }

        // Default Fallback
        return response()->json([
            'reply' => "Halo! Saya EaseBot, asisten virtual RoomEase 🤖.\n\nSaya bisa membantu kamu mengecek **ketersediaan kamar**, **harga kamar**, **fasilitas hotel**, atau **status booking** (dengan kode reservasi kamu). Silakan tanyakan yang kamu butuhkan ya!"
        ]);
    }
}
