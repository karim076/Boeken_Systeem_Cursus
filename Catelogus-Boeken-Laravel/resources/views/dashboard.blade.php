<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Masjid As-sunnah Tilburg-Noord Boekenwinkel">
    <meta name="keywords" content="islamitische boeken, moskee, tilburg, boekenwinkel">
    <meta name="robots" content="index, follow">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

    <!-- Fonts -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #6366f1;
            --secondary: #10b981;
            --dark: #1f2937;
            --light: #f9fafb;
            --gray: #6b7280;
            --gray-light: #e5e7eb;
        }

        .grid-cols-1 {
            grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .stat-card {
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
            border-left: 4px solid;
        }

        .stat-card.books {
            border-color: var(--primary);
        }

        .stat-card.categories {
            border-color: var(--secondary);
        }

        .stat-card.actions {
            border-color: #f59e0b;
        }

        .form-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--gray-light);
            border-radius: 0.375rem;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
        }

        .btn-success {
            background-color: var(--secondary);
            color: white;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .book-card {
            transition: all 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .book-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .book-image-container {
            height: 180px;
            overflow: hidden;
            position: relative;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .book-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .book-card:hover .book-image {
            transform: scale(1.05);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .tab-button {
            padding: 0.75rem 1rem;
            border-bottom: 2px solid transparent;
            font-weight: 500;
            color: var(--gray);
            cursor: pointer;
            transition: all 0.2s;
        }

        .tab-button.active {
            color: var(--primary);
            border-color: var(--primary);
        }

        .file-upload {
            border: 2px dashed var(--gray-light);
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .file-upload:hover {
            border-color: var(--primary-light);
        }

        .file-upload input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .preview-item {
            position: relative;
            width: 80px;
            height: 80px;
            border-radius: 0.25rem;
            overflow: hidden;
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-image {
            position: absolute;
            top: 0;
            right: 0;
            background: rgba(0,0,0,0.5);
            color: white;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0 0 0 0.25rem;
            cursor: pointer;
        }

        .image-counter {
            position: absolute;
            bottom: 0;
            right: 0;
            background: var(--primary);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem 0 0 0;
        }
        .form-section {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .form-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .form-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 3rem;
            height: 3rem;
            border-radius: 0.5rem;
            margin-right: 1rem;
            color: white;
        }

        .form-icon.book {
            background-color: #4f46e5;
        }

        .form-icon.category {
            background-color: #10b981;
        }

        .form-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
        }

        .form-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
        }

        .form-label.required:after {
            content: '*';
            color: #ef4444;
            margin-left: 0.25rem;
        }

        .form-control {
            width: 100%;
            padding: 0.625rem 0.875rem !important;
            border-radius: 0.5rem !important;
            font-size: 0.875rem !important;
            transition: all 0.2s;
            background-color: #f9fafb !important;
        }

        .form-control:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            background-color: white;
        }

        .form-control.select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd' /%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1.25rem;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        /* Enhanced file upload styling (keeping your great implementation) */
        .file-upload {
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background-color: #f9fafb;
            margin-top: 1rem;
        }

        .file-upload:hover {
            border-color: #4f46e5;
            background-color: #f0f1ff;
        }

        .file-upload-icon {
            font-size: 2.5rem;
            color: #4f46e5;
            margin-bottom: 1rem;
        }

        .file-upload-text {
            font-size: 1rem;
            color: #4b5563;
            margin-bottom: 0.5rem;
        }

        .file-upload-hint {
            font-size: 0.75rem;
            color: #6b7280;
        }

        /* Preview container styling (keeping your great implementation) */
        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .preview-item {
            position: relative;
            width: 80px;
            height: 80px;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
         /* Custom Navigatie Styling */
        .custom-navbar {
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 50;
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 1rem;
        }

        .nav-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            height: 40px;
            display: flex;
            align-items: center;
        }

        .nav-logo img {
            width: 73px;
            object-fit: contain;
        }

        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .user-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: #374151;
            padding: 0.5rem 0;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 160px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            z-index: 1;
        }

        .dropdown-content a,
        .dropdown-content button {
            color: #374151;
            padding: 0.75rem 1rem;
            text-decoration: none;
            display: block;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .dropdown-content a:hover,
        .dropdown-content button:hover {
            background-color: #f9fafb;
        }

        .show-dropdown {
            display: block;
        }

        .dropdown-icon {
            transition: transform 0.2s ease;
        }

        .rotate-icon {
            transform: rotate(180deg);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Simpele navigatiebalk -->
        <nav class="custom-navbar">
            <div class="nav-container">
                <!-- Logo -->
                <div class="nav-logo">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('storage/images/logo.png') }}" alt="Logo">
                    </a>
                </div>

                <!-- Gebruikersdropdown -->
                <div class="user-dropdown">
                    <button class="user-button" onclick="toggleDropdown()">
                        <span>{{ Auth::user()->name }}</span>
                        <i class='bx bx-chevron-down dropdown-icon'></i>
                    </button>
                    <div id="userDropdown" class="dropdown-content">
                        <a href="{{ route('profile.edit') }}">
                            <i class='bx bx-user mr-2'></i> Profiel
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">
                                <i class='bx bx-log-out mr-2'></i> Uitloggen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <main>
            <div class="py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                        <p class="mt-2 text-gray-600">Manage your books and categories</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <!-- Books Card -->
                        <div class="card stat-card books">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-500">Total Books</h3>
                                    <p class="text-3xl font-bold text-gray-900">{{ $booksCount }}</p>
                                </div>
                                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                                    <i class='bx bx-book text-2xl'></i>
                                </div>
                            </div>
                            <a href="{{ route('books.index') }}" class="mt-4 inline-flex items-center text-indigo-600 hover:text-indigo-800">
                                View all books
                                <i class='bx bx-chevron-right ml-1'></i>
                            </a>
                        </div>

                        <!-- Categories Card -->
                        <div class="card stat-card categories">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-500">Total Categories</h3>
                                    <p class="text-3xl font-bold text-gray-900">{{ $categoriesCount }}</p>
                                </div>
                                <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                                    <i class='bx bx-category text-2xl'></i>
                                </div>
                            </div>
                            <a href="#" class="mt-4 inline-flex items-center text-emerald-600 hover:text-emerald-800">
                                View all categories
                                <i class='bx bx-chevron-right ml-1'></i>
                            </a>
                        </div>

                        <!-- Quick Actions Card -->
                        <div class="card stat-card actions">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-500">Quick Actions</h3>
                                    <p class="text-3xl font-bold text-gray-900">Manage</p>
                                </div>
                                <div class="p-3 rounded-full bg-amber-100 text-amber-600">
                                    <i class='bx bx-cog text-2xl'></i>
                                </div>
                            </div>
                            <div class="mt-4 flex space-x-3">
                                <button onclick="showTab('add-book')" class="text-sm bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full hover:bg-indigo-200">
                                    Add Book
                                </button>
                                <button onclick="showTab('add-category')" class="text-sm bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full hover:bg-emerald-200">
                                    Add Category
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs Navigation -->
                    <div class="flex border-b border-gray-200 mb-6">
                        <button id="recent-books-tab" class="tab-button active" onclick="showTab('recent-books')">
                            <i class='bx bx-book-open mr-2'></i> Recent Books
                        </button>
                        <button id="add-book-tab" class="tab-button" onclick="showTab('add-book')">
                            <i class='bx bx-plus-circle mr-2'></i> Add Book
                        </button>
                        <button id="add-category-tab" class="tab-button" onclick="showTab('add-category')">
                            <i class='bx bx-category-alt mr-2'></i> Add Category
                        </button>
                    </div>

                    <!-- Tab Contents -->
                    <div class="space-y-8">
                        <!-- Recent Books Tab -->
                        <div id="recent-books" class="tab-content active">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($recentBooks as $book)
                                    <div class="bib_card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                        <div class="bib_images relative">
                                            <div class="slider_images h-48 overflow-hidden">
                                                @if($book->primaryImage)
                                                    <img src="{{ asset('storage/books/' . $book->primaryImage->image_path) }}"
                                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                                @else
                                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                        <i class='bx bx-book text-4xl text-gray-400'></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
                                                <span class="text-xs font-medium px-2 py-1 rounded-full {{ $book->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $book->is_available ? 'Available' : 'Out of stock' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <div class="bib_title">
                                                <h3 class="font-bold text-gray-900 truncate">{{ $book->title }}</h3>
                                                <p class="text-sm text-gray-600 truncate">{{ $book->author }}</p>
                                            </div>
                                            <div class="bib_info mt-3 flex justify-between items-center">
                                                <div class="bib_amount text-sm font-medium text-indigo-600">
                                                    €{{ number_format($book->price, 2) }}
                                                </div>
                                                <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded">
                                                    {{ $book->stock }} in stock
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Add Book Tab -->
                        <div id="add-book" class="tab-content">
                            <div class="form-section">
                                <div class="form-header">
                                    <div class="form-icon book">
                                        <i class='bx bx-book-add text-2xl'></i>
                                    </div>
                                    <div>
                                        <h2 class="form-title">Add New Book</h2>
                                        <p class="form-subtitle">Fill in the details to add a new book to your collection</p>
                                    </div>
                                </div>

                                <form action="{{ route('dashboard.store-book') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-grid">
                                        <!-- Basic Info -->
                                        <div>
                                            <div class="form-group">
                                                <label class="form-label required">Title</label>
                                                <input type="text" name="title" required class="form-control" placeholder="Enter book title">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label required">Author</label>
                                                <input type="text" name="author" required class="form-control" placeholder="Enter author name">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label required">Description</label>
                                                <textarea name="description" required rows="4" class="form-control" placeholder="Enter book description"></textarea>
                                            </div>
                                        </div>

                                        <!-- Pricing & Stock -->
                                        <div>
                                            <div class="form-group">
                                                <label class="form-label required">Price</label>
                                                <div class="relative">
                                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">€</span>
                                                    <input type="number" step="0.01" name="price" required class="form-control pl-8" placeholder="0.00">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label required">Stock</label>
                                                <input type="number" name="stock" required class="form-control" placeholder="Enter stock quantity">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Categories</label>
                                                <select name="categories[]" multiple class="form-control select h-auto">
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple categories</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Book Details -->
                                    <div class="form-grid mt-4">
                                        <div class="form-group">
                                            <label class="form-label required">Shelf Number</label>
                                            <input type="text" name="shelf_number" required class="form-control" placeholder="Enter shelf location">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label required">Cover Type</label>
                                            <select name="cover_type" required class="form-control select">
                                                <option value="" disabled selected>Select cover type</option>
                                                <option value="hardcover">Hardcover</option>
                                                <option value="softcover">Softcover</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label required">Pages</label>
                                            <input type="number" name="pages" required class="form-control" placeholder="Enter page count">
                                        </div>
                                    </div>

                                    <!-- More Details -->
                                    <div class="form-grid mt-4">
                                        <div class="form-group">
                                            <label class="form-label required">Language</label>
                                            <select name="language" required class="form-control select">
                                                <option value="" disabled selected>Select language</option>
                                                <option value="arabic">Arabic</option>
                                                <option value="dutch">Dutch</option>
                                                <option value="english">English</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Publication Year</label>
                                            <input type="number" name="publication_year" class="form-control" placeholder="Enter publication year">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label required">Publisher</label>
                                            <input type="text" name="publisher" required class="form-control" placeholder="Enter publisher name">
                                        </div>
                                    </div>

                                    <!-- Images Upload (keeping your great implementation) -->
                                    <div class="mt-6">
                                        <label class="form-label">Book Images (Max 3)</label>
                                        <div class="file-upload" onclick="document.getElementById('book-images').click()">
                                            <i class='bx bx-cloud-upload file-upload-icon'></i>
                                            <p class="file-upload-text">Click to upload images or drag and drop</p>
                                            <p class="file-upload-hint">PNG, JPG, GIF up to 2MB each</p>
                                            <input type="file" id="book-images" name="images[]" multiple accept="image/*" class="hidden" max="3" onchange="previewImages(this)">
                                        </div>
                                        <div id="image-previews" class="preview-container"></div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-save mr-2'></i> Save Book
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Add Category Tab -->
                        <div id="add-category" class="tab-content">
                            <div class="form-section max-w-2xl mx-auto">
                                <div class="form-header">
                                    <div class="form-icon category">
                                        <i class='bx bx-category text-2xl'></i>
                                    </div>
                                    <div>
                                        <h2 class="form-title">Add New Category</h2>
                                        <p class="form-subtitle">Create a new category for your book collection</p>
                                    </div>
                                </div>

                                <form action="{{ route('dashboard.store-category') }}" method="POST">
                                    @csrf
                                    <div class="form-grid">
                                        <div class="form-group">
                                            <label class="form-label required">Name</label>
                                            <input type="text" name="name" required class="form-control" placeholder="Enter category name">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" rows="3" class="form-control" placeholder="Enter category description"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success">
                                            <i class='bx bx-check mr-2'></i> Save Category
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            const icon = document.querySelector('.dropdown-icon');

            dropdown.classList.toggle('show-dropdown');
            icon.classList.toggle('rotate-icon');
        }

        // Sluit dropdown als je erbuiten klikt
        window.onclick = function(event) {
            if (!event.target.matches('.user-button') && !event.target.closest('.user-dropdown')) {
                const dropdowns = document.getElementsByClassName('dropdown-content');
                const icons = document.querySelectorAll('.dropdown-icon');

                for (let i = 0; i < dropdowns.length; i++) {
                    if (dropdowns[i].classList.contains('show-dropdown')) {
                        dropdowns[i].classList.remove('show-dropdown');
                        icons[i].classList.remove('rotate-icon');
                    }
                }
            }
        }
    </script>
    <script>
        function showTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });

            // Deactivate all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
            });

            // Show selected tab content
            document.getElementById(tabId).classList.add('active');

            // Activate selected tab button
            document.getElementById(`${tabId}-tab`).classList.add('active');
        }

        function previewImages(input) {
            const previewContainer = document.getElementById('image-previews');
            previewContainer.innerHTML = '';

            if (input.files.length > 3) {
                alert('You can only upload a maximum of 3 images');
                input.value = '';
                return;
            }

            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';

                    const previewImage = document.createElement('img');
                    previewImage.src = e.target.result;
                    previewImage.className = 'preview-image';

                    const removeBtn = document.createElement('span');
                    removeBtn.className = 'remove-image';
                    removeBtn.innerHTML = '×';
                    removeBtn.onclick = (e) => {
                        e.stopPropagation();
                        previewItem.remove();
                        // Remove the file from the input
                        const files = Array.from(input.files);
                        files.splice(index, 1);
                        const dataTransfer = new DataTransfer();
                        files.forEach(file => dataTransfer.items.add(file));
                        input.files = dataTransfer.files;
                    };

                    const counter = document.createElement('span');
                    counter.className = 'image-counter';
                    counter.textContent = `${index + 1}/${input.files.length}`;

                    previewItem.appendChild(previewImage);
                    previewItem.appendChild(removeBtn);
                    previewItem.appendChild(counter);
                    previewContainer.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
</body>
</html>
