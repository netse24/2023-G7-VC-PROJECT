<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Note: php artisan seed to get exits data. 

        $this->call([
            RoleSeeder::class,
            RoomSeeder::class,
            ClassSeeder::class,
            UserSeeder::class,
            CourseSeeder::class,
<<<<<<< HEAD
            GenerationSeeder::class,
            TermSeeder::class

=======
            TeacherSeeder::class,
            GenerationSeeder::class,
            StudentSeeder::class,
            TermSeeder::class,
            ScheduleSeeder::class,
>>>>>>> c20529eeee3a453f98673802525b02a0589e0e42
        ]);
    }
}
