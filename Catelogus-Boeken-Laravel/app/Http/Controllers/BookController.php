<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = $request->input('categories', []);
        $coverTypes = $request->input('cover_types', []);
        $languages = $request->input('languages', []);
        if($categories != null){
            var_dump("test", );
        die();
        }

        $books = Book::with(['images', 'categories'])
            ->when($search, function ($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('publisher', 'like', "%{$search}%")
                    ->orWhereHas('categories', function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
                });
            })
            ->when(!empty($categories), function($query) use ($categories) {
                $query->whereHas('categories', function($q) use ($categories) {
                    $q->whereIn('categories.id', $categories);
                });
            })
            ->when(!empty($coverTypes), function($query) use ($coverTypes) {
                $query->whereIn('cover_type', $coverTypes);
            })
            ->when(!empty($languages), function($query) use ($languages) {
                $query->whereIn('language', $languages);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categories = Category::all();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('books.partials.book_list', compact('books'))->render(),
                'pagination' => $books->appends($request->query())->links()->toHtml()
            ]);
        }

        return view('books.index', compact('books', 'categories'));
    }
    public function show(Book $book)
    {
        // Eager load images and any other relationships
        $book->load('images');

        return view('books.show', [
            'book' => $book
        ]);
    }
}
