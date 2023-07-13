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
                'address' => 'Prey Veng',
                'role_id' => 1,
            ],
            [
                'first_name' => 'Champa',
                'last_name' => 'Phuong',
                'gender' => 'female',
                'email' => 'champa.phuong@gmail.com',
                'password' => bcrypt('123456789'),
                'date_of_birth' => Carbon::create('2003-05-30'),
                'address' => 'Kompong Cham',
                'role_id' => 2,
            ],
            [
                'first_name' => 'Champey',
                'last_name' => 'Chea',
                'gender' => 'female',
                'email' => 'champey.chea@gmail.com',
                'password' => bcrypt('123456789'),
                'date_of_birth' => Carbon::create('2003-03-30'),
                'address' => 'Kompong Chnang',
                'role_id' => 2,
            ],
            [
                'first_name' => 'Seiha',
                'last_name' => 'Seng',
                'gender' => 'male',
                'email' => 'sieha.seng@gmail.com',
                'password' => bcrypt('123456789'),
                'date_of_birth' => Carbon::create('2003-3-3'),
                'address' => 'Kompong Thom',
                'role_id' => 2,
            ],
            [
                'first_name' => 'Soki',
                'last_name' => 'Chhuoy',
                'gender' => 'female',
                'email' => 'soki.chhuoy@gmail.com',
                'password' => bcrypt('123456789'),
                'date_of_birth' => Carbon::create('2003-3-3'),
                'address' => 'Kompong Cham',
                'role_id' => 3,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        };
    }
}
