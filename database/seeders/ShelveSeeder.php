<?php

namespace Database\Seeders;

use App\Models\Shelve;
use Illuminate\Database\Seeder;

class ShelveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shelves = range('A', 'J');
        
        foreach ($shelves as $key=>$shelve)
        {
            Shelve::create(['shelve' => $shelve]);
        }
    }
}
