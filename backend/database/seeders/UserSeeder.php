<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Net',
                'last_name' => 'Se',
                'gender' => 'male',
                'email' => 'netse0962@gmail.com',
                'password' => bcrypt('123456789'),
                'date_of_birth' => Carbon::create('2002-10-17'),
                'age' => 20,
                'address' => 'Prey Veng',
                'role_id' => 1,
            ],
            [
                'first_name' => 'Thavroth',
                'last_name' => 'Chea',
                'gender' => 'female',
                'email' => 'thavroth.chea@gmail.com',
                'password' => bcrypt('123456789'),
                'date_of_birth' => Carbon::create('2003-3-3'),
                'age' => 19,
                'address' => 'Kompong Cham',
                'role_id' => 1,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        };
    }
}
