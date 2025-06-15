<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        $books = [
            [
                'title' => 'De Schaduw van de Wind',
                'description' => 'Een mysterieuze roman over een vergeten boek.',
                'price' => 16.99,
                'shelf_number' => 'A01',
                'cover_type' => 'hardcover',
                'pages' => 240,
                'language' => 'dutch',
                'publication_year' => 2004,
                'publisher' => 'Signatuur',
                'author' => 'Carlos Ruiz Zafón',
                'stock' => 10,
                'is_available' => true
            ],
            [
                'title' => 'Het Diner',
                'description' => 'Een ongemakkelijk diner met schokkende onthullingen.',
                'price' => 14.50,
                'shelf_number' => 'B02',
                'cover_type' => 'softcover',
                'pages' => 320,
                'language' => 'dutch',
                'publication_year' => 2009,
                'publisher' => 'Anthos',
                'author' => 'Herman Koch',
                'stock' => 7,
                'is_available' => true
            ],
            [
                'title' => 'Joe Speedboot',
                'description' => 'Een coming-of-age verhaal in een klein dorp.',
                'price' => 13.75,
                'shelf_number' => 'C04',
                'cover_type' => 'softcover',
                'pages' => 290,
                'language' => 'dutch',
                'publication_year' => 2005,
                'publisher' => 'De Bezige Bij',
                'author' => 'Tommy Wieringa',
                'stock' => 12,
                'is_available' => true
            ],
            [
                'title' => 'Bonita Avenue',
                'description' => 'Het tragische verhaal van een ogenschijnlijk perfecte familie.',
                'price' => 17.25,
                'shelf_number' => 'D06',
                'cover_type' => 'hardcover',
                'pages' => 400,
                'language' => 'dutch',
                'publication_year' => 2010,
                'publisher' => 'De Bezige Bij',
                'author' => 'Peter Buwalda',
                'stock' => 6,
                'is_available' => true
            ],
            [
                'title' => 'Oorlog en Terpentijn',
                'description' => 'Een indringende roman over oorlog, kunst en familie.',
                'price' => 18.95,
                'shelf_number' => 'E08',
                'cover_type' => 'hardcover',
                'pages' => 340,
                'language' => 'dutch',
                'publication_year' => 2013,
                'publisher' => 'De Bezige Bij',
                'author' => 'Stefan Hertmans',
                'stock' => 9,
                'is_available' => true
            ]
        ];

        Book::insert($books);
    }
}
