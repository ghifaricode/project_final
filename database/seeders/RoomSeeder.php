<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Standard Room',
                'capacity' => 2,
                'price' => 300000,
                'description' => 'Kamar standar dengan fasilitas dasar yang nyaman',
                'image' => 'rooms/standard.jpg',
            ],
            [
                'name' => 'Deluxe Room',
                'capacity' => 2,
                'price' => 500000,
                'description' => 'Kamar deluxe dengan pemandangan dan fasilitas lebih lengkap',
                'image' => 'rooms/deluxe.jpg',
            ],
            [
                'name' => 'Family Room',
                'capacity' => 4,
                'price' => 800000,
                'description' => 'Kamar keluarga yang luas dengan fasilitas lengkap',
                'image' => 'rooms/family.jpg',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
