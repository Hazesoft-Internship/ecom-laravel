<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'description'=>fake()->text(5),
            'price'=>fake()->numberBetween(10,10000),
            'quantity'=>fake()->numberBetween(1,1000),
            'types' => fake()->randomElement(['physsical', 'digital']),
            'user_id' =>  User::factory()

        ];
    }
}
