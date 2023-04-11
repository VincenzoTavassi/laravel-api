<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            $project = new Project;
            $project->title = $faker->catchPhrase();
            $project->link = $faker->imageUrl(360, 360, 'animals', true);
            $project->description = $faker->paragraphs(2, true);
            $project->date = $faker->date();
            $project->save();
        }
    }
}
