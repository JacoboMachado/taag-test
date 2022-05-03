<?php

namespace Database\Seeders;

use App\Models\BookOnShelf;
use Illuminate\Database\Seeder;

class BookOnShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookOnShelf::factory(100)->create();
    }
}
