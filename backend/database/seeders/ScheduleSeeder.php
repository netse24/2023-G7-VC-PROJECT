<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'course_id' => 1,  'teacher_id' => 1,
                'class_id' => 1, 'room_id' => 1,
                'start_date' => '2023-07-31', 'end_date' => '2023-07-31',
                'start_time' => '07:30:00', 'end_time' => '09:00:00'
            ],
            [
                'course_id' => 2,  'teacher_id' => 2,
                'class_id' => 2, 'room_id' => 2,
                'start_date' => '2023-07-27', 'end_date' => '2023-07-27',
                'start_time' => '07:30:00', 'end_time' => '09:00:00'
            ],
            [
                'course_id' => 3,  'teacher_id' => 3,
                'class_id' => 3, 'room_id' => 3,
                'start_date' => '2023-07-28', 'end_date' => '2023-07-28',
                'start_time' => '07:30:00', 'end_time' => '09:00:00'
            ],
        ];
        foreach($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
