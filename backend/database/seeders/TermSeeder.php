<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $terms = [
            [
<<<<<<< HEAD
                'term' => "01",
            ],
            [
                'term' => "02",
               
            ],
            [
                'term' => "03",

            ],
            [
                'term' => "04",

            ],
            [
                'term' => "05",

            ],
        ];
        foreach ($terms as $term) {
            Term::create($term);
        }
=======
                'term' => '01'
            ],
            [
                'term' => '02'

            ],
            [
                'term' => '03'

            ],
            [
                'term' => '04'

            ],
        ];

        foreach ($terms as $term) {
            Term::create($term);
        };
>>>>>>> c20529eeee3a453f98673802525b02a0589e0e42
    }
}
