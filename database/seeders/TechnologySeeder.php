<?php

namespace Database\Seeders;

use App\Models\Technology;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $available_technologies = ['PHP', 'HTML', 'CSS', 'JavaScript', 'Bootstrap', 'Blade'];

        foreach ($available_technologies as $available_technology) {
            $technology = new Technology;
            $technology->title = $available_technology;
            $technology->color = $faker->hexColor();
            $technology->save();
        }
    }
}
