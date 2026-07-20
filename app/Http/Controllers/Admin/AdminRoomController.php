<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::with('roomType')->orderBy('room_number');

        if ($request->filled('room_type_id')) {
            $query->where('room_type_id', $request->room_type_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $rooms = $query->paginate(20)->withQueryString();
        $roomTypes = RoomType::all();

        return view('admin.rooms.index', compact('rooms', 'roomTypes'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.form', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number'  => 'required|string|max:20|unique:rooms,room_number',
            'status'       => 'required|in:available,occupied,maintenance',
        ]);

        Room::create($data);
        return redirect()->route('admin.rooms.index')->with('success', "Kamar {$data['room_number']} berhasil ditambahkan.");
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.form', compact('room', 'roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number'  => "required|string|max:20|unique:rooms,room_number,{$room->id}",
            'status'       => 'required|in:available,occupied,maintenance',
        ]);

        $room->update($data);
        return redirect()->route('admin.rooms.index')->with('success', "Kamar {$data['room_number']} berhasil diperbarui.");
    }

    public function destroy(Room $room)
    {
        if ($room->reservationDetails()->exists()) {
            return back()->with('error', 'Tidak bisa menghapus kamar yang sudah pernah di-booking.');
        }
        $number = $room->room_number;
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', "Kamar {$number} berhasil dihapus.");
    }
}
