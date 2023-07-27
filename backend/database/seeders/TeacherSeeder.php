<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'user_id' => 2,
                'course_id' => 1
            ],
            [
                'user_id' => 3,
                'course_id' => 2
            ],
            [
                'user_id' => 4,
                'course_id' => 3
            ],
        ];
        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
