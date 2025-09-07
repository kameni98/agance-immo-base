<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = City::count();
        $rooms = $this->faker->numberBetween(2, 10);
        return [
            'title' => $this->faker->sentence(4, true),
            'description' => $this->faker->realText(),
            'surface' => $this->faker->randomNumber(4, true),
            'price' => $this->faker->randomNumber(6, true),
            'rooms' => $rooms,
            'bedrooms' => $this->faker->numberBetween(1, $rooms),
            'floor' => $this->faker->randomNumber(1, true),
            'city_id' => $this->faker->numberBetween(1, $cities),
            'address' => $this->faker->address(),
            'postal_code' => $this->faker->postcode(),
            'sold' => $this->faker->boolean()
        ];
    }


}
