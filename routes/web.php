<?php

use App\Models\Guest;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\RoomType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/rooms', 'rooms.index')->name('rooms.index');

Route::get('/rooms/{room}', function (string $room) {
    $rooms = [
        'essential' => ['name' => 'The Essential', 'type' => 'Essential', 'description' => 'Calm, considered, and everything you need.', 'guests' => '1–2 guests', 'bed' => 'King bed', 'price' => '850k', 'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1200&q=85'],
        'garden' => ['name' => 'The Garden', 'type' => 'Deluxe', 'description' => 'A bright room made for slow mornings.', 'guests' => '1–3 guests', 'bed' => 'King bed', 'price' => '1.1jt', 'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1200&q=85'],
        'garden-suite' => ['name' => 'The Garden Suite', 'type' => 'Suite', 'description' => 'More room, more light, more time together.', 'guests' => '1–4 guests', 'bed' => 'King bed', 'price' => '1.25jt', 'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=85'],
        'corner-suite' => ['name' => 'The Corner Suite', 'type' => 'Suite', 'description' => 'A little extra space with a view to match.', 'guests' => '1–4 guests', 'bed' => 'King bed', 'price' => '1.5jt', 'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1200&q=85'],
    ];

    abort_unless(isset($rooms[$room]), 404);

    return view('rooms.show', ['room' => $rooms[$room]]);
})->name('rooms.show');

// --- Slug-to-RoomType name map (used by booking routes) ---
function roomSlugToName(string $slug): string
{
    return match ($slug) {
        'essential' => 'The Essential',
        'garden' => 'The Garden',
        'garden-suite' => 'The Garden Suite',
        'corner-suite' => 'The Corner Suite',
        default => abort(404),
    };
}

Route::get('/rooms/{room}/booking', function (string $room) {
    $roomType = RoomType::where('name', roomSlugToName($room))->firstOrFail();

    $checkInStr = request('check_in');
    $checkOutStr = request('check_out');

    $nights = 1;
    if ($checkInStr && $checkOutStr) {
        try {
            $nights = max(1, (new DateTime($checkInStr))->diff(new DateTime($checkOutStr))->days);
        } catch (Exception) {
            $nights = 1;
        }
    }

    $totalRaw = $roomType->price_per_night * $nights;

    return view('booking.create', ['booking' => [
        'room' => $room,
        'name' => $roomType->name,
        'guests_label' => "1–{$roomType->capacity} guests",
        'bed' => 'King bed',
        'price_raw' => $roomType->price_per_night,
        'price' => number_format($roomType->price_per_night, 0, ',', '.'),
        'image' => match ($room) {
            'essential' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=900&q=85',
            'garden' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=900&q=85',
            'garden-suite' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=900&q=85',
            default => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=900&q=85',
        },
        'check_in' => $checkInStr ?? '',
        'check_out' => $checkOutStr ?? '',
        'guests' => preg_replace('/\D+/', '', (string) request('guests', '1')) ?: '1',
        'nights' => $nights,
        'total_price' => number_format($totalRaw, 0, ',', '.'),
    ]]);
})->name('booking.create');

Route::post('/rooms/{room}/booking', function (string $room) {
    $data = request()->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:30',
        'email' => 'nullable|email|max:255',
        'nik' => 'nullable|string|max:30',
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
        'guests' => 'required|integer|min:1|max:10',
    ]);

    $roomType = RoomType::where('name', roomSlugToName($room))->firstOrFail();
    $availableRoom = $roomType->rooms()->where('status', 'available')->firstOrFail();

    $nights = max(1, (new DateTime($data['check_in']))->diff(new DateTime($data['check_out']))->days);
    $totalPrice = $roomType->price_per_night * $nights;
    $code = 'RE-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));

    $reservation = DB::transaction(function () use ($data, $availableRoom, $roomType, $totalPrice, $code) {
        $guest = Guest::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'],
            'nik' => $data['nik'] ?? null,
        ]);

        $reservation = Reservation::create([
            'guest_id' => $guest->id,
            'reservation_code' => $code,
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        $reservation->reservationDetails()->create([
            'room_id' => $availableRoom->id,
            'price' => $roomType->price_per_night,
        ]);

        Payment::create([
            'reservation_id' => $reservation->id,
            'payment_method' => 'cash',
            'amount' => $totalPrice,
            'status' => 'unpaid',
        ]);

        return $reservation;
    });

    return redirect()->route('booking.payment', $reservation->reservation_code);
})->name('booking.store');

Route::get('/booking/{code}/payment', function (string $code) {
    $reservation = Reservation::where('reservation_code', $code)
        ->with(['guest', 'reservationDetails.room.roomType', 'payment'])
        ->firstOrFail();

    $detail = $reservation->reservationDetails->first();
    $roomType = $detail->room->roomType;
    $nights = max(1, $reservation->check_in->diffInDays($reservation->check_out));

    return view('booking.payment', [
        'reservation' => $reservation,
        'roomType' => $roomType,
        'room' => $detail->room,
        'nights' => $nights,
    ]);
})->name('booking.payment');

Route::post('/booking/{code}/pay', function (string $code) {
    $method = request()->validate(['payment_method' => 'required|in:cash,transfer,e-wallet'])['payment_method'];

    $reservation = Reservation::where('reservation_code', $code)->firstOrFail();
    $reservation->payment->update([
        'payment_method' => $method,
        'payment_date' => now(),
        'status' => 'paid',
    ]);
    $reservation->update(['status' => 'confirmed']);

    $detail = $reservation->reservationDetails->first();
    $detail->room->update(['status' => 'occupied']);

    return redirect()->route('booking.confirmation', $code);
})->name('booking.pay');

Route::get('/booking/{code}/confirmation', function (string $code) {
    $reservation = Reservation::where('reservation_code', $code)
        ->with(['guest', 'reservationDetails.room.roomType', 'payment'])
        ->firstOrFail();

    abort_unless($reservation->status === 'confirmed', 404);

    $detail = $reservation->reservationDetails->first();
    $nights = max(1, $reservation->check_in->diffInDays($reservation->check_out));

    return view('booking.confirmation', [
        'reservation' => $reservation,
        'roomType' => $detail->room->roomType,
        'room' => $detail->room,
        'nights' => $nights,
    ]);
})->name('booking.confirmation');
