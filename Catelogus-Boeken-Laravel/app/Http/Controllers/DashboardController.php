<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('/dashboard', [
            'booksCount' => Book::count(),
            'categoriesCount' => Category::count(),
            'categories' => Category::all(), // Add this to show categories in dropdown
            'recentBooks' => Book::with('images')->latest()->take(5)->get(),
        ]);
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('dashboard')->with('success', 'Category added successfully!');
    }

    public function storeBook(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'shelf_number' => 'required|string|max:50',
            'cover_type' => 'required|in:hardcover,softcover',
            'pages' => 'required|integer|min:1',
            'language' => 'required|in:arabic,dutch,english,other',
            'publication_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'publisher' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book = Book::create($validated);

        // Attach categories
        if ($request->has('categories')) {
            $book->categories()->attach($request->categories);
        }

        // Handle images
        // When saving images in your controller:
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $path = $image->store('book_images', 'public'); // Store in public disk
                $book->images()->create([
                    'image_path' => Storage::url($path), // This creates the correct public URL
                    'is_primary' => $key === 0,
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Book added successfully!');
    }
}
