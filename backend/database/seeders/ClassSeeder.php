<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'name' => 'WEP B',
                'room_id' => 1,
            ],
            [
                'name' => 'SNA',
                'room_id' => 2,
            ],
            [
                'name' => 'WEP A',
                'room_id' => 3,
            ],
        ];
        foreach ($classes as $class) {
            Classes::create($class);
        };
    }
}
