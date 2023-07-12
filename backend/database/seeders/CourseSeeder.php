<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'course' => 'HMTL',
            ],
            [
                'course' => 'LARAVEL',
            ],
            [
                'course' => 'OOP',
            ],
            [
                'course' => 'DB',
            ],
        ];
        foreach ($courses as $course) {
            Course::create($course);
        };
    }
}
