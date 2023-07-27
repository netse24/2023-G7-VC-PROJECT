<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'B12'
            ],
            [
                'name' => 'B13'
            ],
            [
                'name' => 'B31'
            ],
            [
                'name' => 'B32'
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        };
    }
}
