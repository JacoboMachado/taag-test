<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Shelve;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookOnShelfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id' => Book::all()->random()->id,
            'shelve_id' => Shelve::all()->random()->id,
        ];
    }
}
