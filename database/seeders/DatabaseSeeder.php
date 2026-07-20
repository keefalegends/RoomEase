<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $hotel = Hotel::create([
            'name' => 'RoomEase Hotel',
            'address' => 'Jl. Bunga Raya No. 12, Bandung, Jawa Barat',
            'phone' => '022-1234567',
            'description' => 'A boutique hotel with thoughtfully designed rooms and warm service.',
        ]);

        $types = [
            ['name' => 'The Essential', 'description' => 'Calm, considered, and everything you need.', 'price_per_night' => 850000, 'capacity' => 2, 'rooms' => ['101', '102', '103']],
            ['name' => 'The Garden', 'description' => 'A bright room made for slow mornings.', 'price_per_night' => 1100000, 'capacity' => 3, 'rooms' => ['201', '202']],
            ['name' => 'The Garden Suite', 'description' => 'More room, more light, more time together.', 'price_per_night' => 1250000, 'capacity' => 4, 'rooms' => ['301', '302']],
            ['name' => 'The Corner Suite', 'description' => 'A little extra space with a view to match.', 'price_per_night' => 1500000, 'capacity' => 4, 'rooms' => ['401']],
        ];

        foreach ($types as $type) {
            $rooms = $type['rooms'];
            unset($type['rooms']);

            $roomType = $hotel->roomTypes()->create($type);

            foreach ($rooms as $number) {
                $roomType->rooms()->create([
                    'room_number' => $number,
                    'status' => 'available',
                ]);
            }
        }
    }
}
