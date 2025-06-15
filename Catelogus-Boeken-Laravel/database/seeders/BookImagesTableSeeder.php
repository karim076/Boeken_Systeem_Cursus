<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookImage;
use Illuminate\Database\Seeder;

class BookImagesTableSeeder extends Seeder
{
    public function run()
    {
        $books = Book::all();
        $counter = 1;

        foreach ($books as $book) {
            for ($i = 1; $i <= 3; $i++) {
                BookImage::create([
                    'book_id' => $book->id,
                    'image_path' => "boek-{$counter}.jpg",
                    'is_primary' => $i === 1
                ]);
            }
            $counter++;
        }
    }
}
