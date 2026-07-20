<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['guest', 'payment', 'reservationDetails.room.roomType'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('reservation_code', 'like', "%{$search}%")
                  ->orWhereHas('guest', fn($g) => $g->where('name', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%"));
            });
        }

        $reservations = $query->paginate(15)->withQueryString();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['guest', 'payment', 'reservationDetails.room.roomType']);
        $nights = max(1, $reservation->check_in->diffInDays($reservation->check_out));

        return view('admin.reservations.show', compact('reservation', 'nights'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
        ]);

        $reservation->update(['status' => $data['status']]);

        // Sync room status automatically
        $detail = $reservation->reservationDetails->first();
        if ($detail) {
            $room = $detail->room;
            $roomStatus = match ($data['status']) {
                'checked_in'  => 'occupied',
                'checked_out', 'cancelled' => 'available',
                default       => $room->status,
            };
            $room->update(['status' => $roomStatus]);
        }

        return back()->with('success', 'Status reservasi berhasil diperbarui.');
    }
}
