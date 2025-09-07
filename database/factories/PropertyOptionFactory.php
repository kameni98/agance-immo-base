<?php

namespace Database\Factories;

use App\Models\Option;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PropertyOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return void
     */
    public static function run(): void
    {
        $optionsT = Option::count();
        $properties = Property::get();
        foreach ($properties as $property) {
            $options = [];
            for ($i = 1; $i < rand(1,$optionsT); $i++) {
                $options[] = $i;
            }
            $property->options()->sync($options);

        }

    }

    public function definition()
    {

    }
}
