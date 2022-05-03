<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'publication' => $this->faker->year($max = 'now'),
            'category_id' => Category::all()->random()->id,
            'author_id' => Author::all()->random()->id
        ];
    }
}
