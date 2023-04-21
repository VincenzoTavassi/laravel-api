<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // SELEZIONE DI TYPES RANDOM 
        $types = Type::select('id')->get(); // Ottengo tutti gli id
        $type_ids = []; // Preparo array

        foreach ($types as $type) { // Per ogni tipo
            $type_ids[] = $type->id; // Aggiungo l'id all'array
        }

        $technologies = Technology::select('id')->get();
        $technology_ids = []; // Preparo array

        foreach ($technologies as $technology) { // Per ogni tipo
            $technology_ids[] = $technology->id; // Aggiungo l'id all'array
        }


        for ($i = 0; $i < 50; $i++) {

            $type_id_random_key = array_rand($type_ids); // Key random dell'array
            $technology_id_random_key = array_rand($technology_ids); // Key random dell'array

            $project = new Project;
            $project->title = $faker->catchPhrase();
            $project->link =  'https://picsum.photos/800/1000?random=' . $i;
            $project->description = $faker->paragraphs(2, true);
            $project->date = $faker->date();
            $project->type_id = $type_ids[$type_id_random_key]; // Random Type
            $project->save();
            $project->technologies()->attach($technology_ids[$technology_id_random_key]); // Attach random id dall'array technology_ids
        }
    }
}
