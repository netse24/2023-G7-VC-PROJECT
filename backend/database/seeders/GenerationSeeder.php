<?php

namespace Database\Seeders;

use App\Models\Generation;
use Illuminate\Database\Seeder;

class GenerationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generations = [
            [
                'name' => '2023'
            ],
            [
                'name' => '2024'
            ],
            [
                'name' => '2025'
            ],
        ];

        foreach ($generations as $generation) {
            Generation::create($generation);
        };
    }
}
