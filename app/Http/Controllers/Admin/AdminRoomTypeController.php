<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\RoomType;
use Illuminate\Http\Request;

class AdminRoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::withCount('rooms')->get();
        return view('admin.room-types.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('admin.room-types.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string|max:1000',
            'price_per_night' => 'required|numeric|min:0',
            'capacity'        => 'required|integer|min:1|max:20',
        ]);

        $hotel = Hotel::firstOrFail();
        $data['hotel_id'] = $hotel->id;
        RoomType::create($data);

        return redirect()->route('admin.room-types.index')->with('success', 'Tipe kamar berhasil ditambahkan.');
    }

    public function edit(RoomType $roomType)
    {
        return view('admin.room-types.form', compact('roomType'));
    }

    public function update(Request $request, RoomType $roomType)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string|max:1000',
            'price_per_night' => 'required|numeric|min:0',
            'capacity'        => 'required|integer|min:1|max:20',
        ]);

        $roomType->update($data);
        return redirect()->route('admin.room-types.index')->with('success', 'Tipe kamar berhasil diperbarui.');
    }

    public function destroy(RoomType $roomType)
    {
        if ($roomType->rooms()->exists()) {
            return back()->with('error', 'Tidak bisa menghapus tipe kamar yang masih punya kamar terdaftar.');
        }
        $roomType->delete();
        return redirect()->route('admin.room-types.index')->with('success', 'Tipe kamar berhasil dihapus.');
    }
}
