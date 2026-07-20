<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/rooms/{room}/booking', function (string $room) {
    $bookings = [
        'essential' => ['room' => 'essential', 'name' => 'The Essential', 'guests_label' => '1–2 guests', 'guests' => '1', 'bed' => 'King bed', 'price_raw' => 850000, 'price' => '850.000', 'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=900&q=85'],
        'garden' => ['room' => 'garden', 'name' => 'The Garden', 'guests_label' => '1–3 guests', 'guests' => '1', 'bed' => 'King bed', 'price_raw' => 1100000, 'price' => '1.100.000', 'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=900&q=85'],
        'garden-suite' => ['room' => 'garden-suite', 'name' => 'The Garden Suite', 'guests_label' => '1–4 guests', 'guests' => '1', 'bed' => 'King bed', 'price_raw' => 1250000, 'price' => '1.250.000', 'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=900&q=85'],
        'corner-suite' => ['room' => 'corner-suite', 'name' => 'The Corner Suite', 'guests_label' => '1–4 guests', 'guests' => '1', 'bed' => 'King bed', 'price_raw' => 1500000, 'price' => '1.500.000', 'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=900&q=85'],
    ];

    abort_unless(isset($bookings[$room]), 404);

    $checkInStr = request('check_in');
    $checkOutStr = request('check_out');

    $nights = 1;
    if ($checkInStr && $checkOutStr) {
        try {
            $checkIn = new DateTime($checkInStr);
            $checkOut = new DateTime($checkOutStr);
            $diff = $checkIn->diff($checkOut);
            $nights = max(1, $diff->days);
        } catch (Exception $e) {
            $nights = 1;
        }
    }

    $priceRaw = $bookings[$room]['price_raw'];
    $totalPriceRaw = $priceRaw * $nights;

    $booking = $bookings[$room] + [
        'check_in' => $checkInStr ?? '',
        'check_out' => $checkOutStr ?? '',
        'guests' => preg_replace('/\D+/', '', (string) request('guests', '1')) ?: '1',
        'nights' => $nights,
        'total_price' => number_format($totalPriceRaw, 0, ',', '.'),
    ];

    return view('booking.create', ['booking' => $booking]);
})->name('booking.create');

Route::post('/rooms/{room}/booking', function (string $room) {
    // Temporary redirect back with a success message since we are focusing on UI/flow first
    return redirect()->route('rooms.index')->with('success', 'Booking temporary request received!');
})->name('booking.store');
