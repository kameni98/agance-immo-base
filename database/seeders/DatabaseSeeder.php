<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Option;
use App\Models\Property;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\PropertyOptionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents; //pour éviter le déclenchements des evenements pendant le seed
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Yann Silver',
            'email' => 'yann@tartatos.com',
            'password' => 'Superpass2025'
        ]);

        City::factory(10)->create();
        $options = Option::factory(10)->create();
        //on met la boucle ici pour permettre de varier le nombre d'option
        for ($i = 0; $i < 49; $i++) {
            Property::factory(1)
                ->hasAttached($options->random(rand(0,4)))//on attache 0 ou plusieurs options
                ->create();
        }

        //on pouvait aussi faire le code ci dessous si on veut pas faire de boucle
        /*foreach ($properties as $property) {
            $options = [];
            for ($i = 1; $i < rand(1,$options->count()); $i++) {
                $options[] = $i;
            }
            $property->options()->sync($options);

        }*/
        //PropertyOptionFactory::run();
    }
}
