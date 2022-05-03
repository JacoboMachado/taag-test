<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['category' => 'Obras generales'],
            ['category' => 'Filosofía. Psicología. Religión'],
            ['category' => 'Ciencias Auxiliares de la Historia'],
            ['category' => 'Historia, General y Antigua'],
            ['category' => 'Historia: Chile'],
            ['category' => 'Geografía. Antropología. Recreo'],
            ['category' => 'Ciencias Sociales'],
            ['category' => 'Ciencia Política'],
            ['category' => 'Derecho'],
            ['category' => 'Educación'],
            ['category' => 'Música y Libros sobre Música'],
            ['category' => 'Bellas Artes'],
            ['category' => 'Lengua y Literatura'],
            ['category' => 'Ciencia'],
            ['category' => 'Medicina'],
            ['category' => 'Agricultura'],
            ['category' => 'Tecnología'],
            ['category' => 'Ciencia Militar'],
            ['category' => 'Ciencia Naval'],
            ['category' => 'Bibliografía. Biblioteconomía. Recursos Informativos (General)']
        ];

        Category::insert($categories);

    }
}
