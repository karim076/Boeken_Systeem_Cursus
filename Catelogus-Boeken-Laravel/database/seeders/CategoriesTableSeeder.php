<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Romans', 'description' => 'Fictieve verhalen en vertellingen'],
            ['name' => 'Literatuur', 'description' => 'Nederlandse en internationale literaire werken'],
            ['name' => 'Historische Fictie', 'description' => 'Romans gebaseerd op historische gebeurtenissen'],
            ['name' => 'Psychologische Romans', 'description' => 'Boeken met psychologische diepgang'],
            ['name' => 'Coming of Age', 'description' => 'Verhalen over volwassen worden en zelfontwikkeling']
        ];

        Category::insert($categories);
    }
}
