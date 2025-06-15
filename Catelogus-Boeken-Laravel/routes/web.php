<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\InschrijvenController;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/books', [BookController::class, 'index'])->name('books.index'); // Add this line
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::post('/', [BookController::class, 'index'])->name('home.filter');

Route::get('/books/search', [BookController::class, 'index'])->name('books.search');
Route::get('/books/filter', [BookController::class, 'index'])->name('books.filter');
Route::get('/books/category/{category}', [BookController::class, 'index'])->name('books.category');
Route::get('/books/cover-type/{coverType}', [BookController::class, 'index'])->name('books.cover-type');
Route::get('/books/language/{language}', [BookController::class, 'index'])->name('books.language');
Route::get('/books/author/{author}', [BookController::class, 'index'])->name('books.author');
Route::get('/books/publisher/{publisher}', [BookController::class, 'index'])->name('books.publisher');

Route::get('/inschrijven', [InschrijvenController::class, 'show'])->name('inschrijven.index');
Route::post('/inschrijven', function() {
    $data = request()->validate([
        'naam' => 'required',
        'achternaam' => 'required',
        'geboortedatum' => 'required|date',
        'telefoon' => 'required',
        'email' => 'required|email',
        'opleiding' => 'required'
    ]);

    // Mail naar admin
    Mail::send('emails.inschrijving', $data, function($message) {
        $message->to('masjid-assunnah@gmail.com')
                ->subject('Nieuwe inschrijving');
    });

    // Bevestiging naar gebruiker
    Mail::send('emails.bevestiging', $data, function($message) use ($data) {
        $message->to($data['email'])
                ->subject('Inschrijvingsbevestiging');
    });

    return back()->with('success', 'Bedankt! We hebben je inschrijving ontvangen.');
});

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('dashboard')->group(function () {
        Route::post('/category', [DashboardController::class, 'storeCategory'])->name('dashboard.store-category');
        Route::post('/book', [DashboardController::class, 'storeBook'])->name('dashboard.store-book');
    });
    // Add other protected routes here
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::middleware('guest')->group(function () {
    // Show registration form (GET)
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

    // Handle registration submission (POST)
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Login routes...
});
Route::get('/password/reset', [PasswordController::class, 'edit'])->name('password.edit');
Route::post('/password/reset', [PasswordController::class, 'update'])->name('password.update');
Route::get('/password/change', [PasswordController::class, 'edit'])->name('password.edit');
Route::post('/password/change', [PasswordController::class, 'update'])->name('password.update');
Route::get('/password/confirm', [PasswordController::class, 'edit'])->name('password.confirm');
Route::post('/password/confirm', [PasswordController::class, 'update'])->name('password.confirm');
Route::get('/password/edit', [PasswordController::class, 'edit'])->name('password.edit');
Route::post('/password/edit', [PasswordController::class, 'update'])->name('password.update');
Route::get('/password/reset/{token}', [PasswordController::class, 'edit'])->name('password.reset');
Route::post('/password/reset', [PasswordController::class, 'update'])->name('password.update');
Route::get('/password/change', [PasswordController::class, 'edit'])->name('password.change');
Route::post('/password/change', [PasswordController::class, 'update'])->name('password.change');
Route::get('/password/confirm', [PasswordController::class, 'edit'])->name('password.confirm');
Route::post('/password/confirm', [PasswordController::class, 'update'])->name('password.confirm');
Route::get('/password/edit', [PasswordController::class, 'edit'])->name('password.edit');
Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
// Reservation routes
// Route::middleware(['auth'])->group(function () {
//     Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
// });

// // Admin routes used later not now
// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::resource('books', BookController::class)->except(['show']);
//     Route::post('books/{book}/stock', [BookController::class, 'updateStock'])->name('books.stock.update');
// });

// // Reservation route
// Route::get('/reservations', [ReservationController::class, 'index'])
//      ->name('reservations.index')
//      ->middleware('auth');


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';
