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
                'email' => 'net@admin.com',
                'password' => bcrypt('a123456789'),
                'date_of_birth' => Carbon::create('2002-10-17'),
                'address' => 'Prey Veng',
                'role_id' => 1,
            ],
            [
                'first_name' => 'Champa',
                'last_name' => 'Phuong',
                'gender' => 'female',
                'email' => 'champa@gmail.com',
                'password' => bcrypt('a123456789'),
                'date_of_birth' => Carbon::create('2003-05-30'),
                'address' => 'Kompong Cham',
                'role_id' => 2,
            ],
            [
                'first_name' => 'Thavroth',
                'last_name' => 'Chea',
                'gender' => 'female',
                'email' => 'thavroth@gmail.com',
                'password' => bcrypt('a123456789'),
                'date_of_birth' => Carbon::create('2003-3-3'),
                'address' => 'Kompong Thom',
                'role_id' => 2,
            ],
            [
                'first_name' => 'Soknoeurn',
                'last_name' => 'Srun',
                'gender' => 'female',
                'email' => 'soknoeurn@gmail.com',
                'password' => bcrypt('a123456789'),
                'date_of_birth' => Carbon::create('2003-2-6'),
                'address' => 'Preyveng',
                'role_id' => 2,
            ],
            [
                'first_name' => 'Soki',
                'last_name' => 'Chhuoy',
                'gender' => 'female',
                'email' => 'soki@gmail.com',
                'password' => bcrypt('a123456789'),
                'date_of_birth' => Carbon::create('2003-3-3'),
                'address' => 'BTC',
                'role_id' => 3,
            ],
          
            [
                'first_name' => 'Srey pheap',
                'last_name' => 'Khim',
                'gender' => 'female',
                'email' => 'pheap@gmail.com',
                'password' => bcrypt('a123456789'),
                'date_of_birth' => Carbon::create('2004-12-12'),
                'address' => 'Porsat',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Dariya',
                'last_name' => 'Thorn',
                'gender' => 'female',
                'email' => 'dariya@gmail.com',
                'password' => bcrypt('a123456789'),
                'date_of_birth' => Carbon::create('2002-4-24'),
                'address' => 'Oddarmeanchey',
                'role_id' => 3,
            ],
            [
                'first_name' => 'cham',
                'last_name' => 'you',
                'gender' => 'male',
                'email' => 'you@gmail.com',
                'password' => bcrypt('a123456789'),
                'date_of_birth' => Carbon::create('2002-4-24'),
                'address' => 'Prey Veng',
                'role_id' => 3,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        };
    }
}
