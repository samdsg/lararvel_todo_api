<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            Todo::create([
                'title' => $faker->sentence($nbWords = 4, $variableNbWords = false),
                'todoId' => Str::random(10),
            ]);
        }
    }
}
