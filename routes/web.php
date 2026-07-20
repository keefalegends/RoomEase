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
