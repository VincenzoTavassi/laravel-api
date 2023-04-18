<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
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

        for ($i = 0; $i < 50; $i++) {

            $type_id_random = rand(1, count($type_ids)); // Selezione di un type id random tra quelli disponibili

            $project = new Project;
            $project->title = $faker->catchPhrase();
            $project->link = $faker->imageUrl(360, 360, 'animals', true);
            $project->description = $faker->paragraphs(2, true);
            $project->date = $faker->date();
            $project->type_id = $type_id_random; // Random Type
            $project->save();
        }
    }
}
