<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['id' => 'RM1', 'room_type' => 'Standard Room', 'price' => 700000, 'available_rooms' => 10],
            ['id' => 'RM2', 'room_type' => 'Superior Room', 'price' => 1500000, 'available_rooms' => 8],
            ['id' => 'RM3', 'room_type' => 'Suite Room', 'price' => 2300000, 'available_rooms' => 5],
            ['id' => 'RM4', 'room_type' => 'Deluxe Room', 'price' => 1300000, 'available_rooms' => 12],
            ['id' => 'RM5', 'room_type' => 'Family Room', 'price' => 1800000, 'available_rooms' => 6],
            ['id' => 'RM6', 'room_type' => 'Executive Room', 'price' => 1700000, 'available_rooms' => 7],
            ['id' => 'RM7', 'room_type' => 'View Room', 'price' => 1700000, 'available_rooms' => 9],
            ['id' => 'RM8', 'room_type' => 'Honeymoon Room', 'price' => 2500000, 'available_rooms' => 4],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
