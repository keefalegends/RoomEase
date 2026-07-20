<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Room;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalReservations   = Reservation::count();
        $todayReservations   = Reservation::whereDate('check_in', today())->count();
        $pendingReservations = Reservation::where('status', 'pending')->count();
        $confirmedReservations = Reservation::where('status', 'confirmed')->count();
        $totalRevenue        = Payment::where('status', 'paid')->sum('amount');
        $availableRooms      = Room::where('status', 'available')->count();
        $occupiedRooms       = Room::where('status', 'occupied')->count();

        $recentReservations = Reservation::with(['guest', 'payment'])
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalReservations',
            'todayReservations',
            'pendingReservations',
            'confirmedReservations',
            'totalRevenue',
            'availableRooms',
            'occupiedRooms',
            'recentReservations',
        ));
    }
}
