<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookCategoryTableSeeder extends Seeder
{
    public function run()
    {
        $books = Book::all();
        $categories = Category::all();

        foreach ($books as $book) {
            // Assign random categories to each book (1-3 categories per book)
            $randomCategories = $categories->random(rand(1, 3))->pluck('id');
            $book->categories()->attach($randomCategories);
        }
    }
}
