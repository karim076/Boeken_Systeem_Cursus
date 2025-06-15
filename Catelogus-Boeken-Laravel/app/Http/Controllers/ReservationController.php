<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // public function index()
    // {
    //     $reservations = Auth::user()->reservations()->with('book')->get();
    //     return view('reservations.index', compact('reservations'));
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
            'pickup_date' => 'required|date|after:today'
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if (!$book->can_be_reserved || $validated['quantity'] > $book->stock) {
            return back()->with('error', 'Dit boek is niet beschikbaar in de gevraagde hoeveelheid.');
        }

        // Create reservation
        $reservation = Reservation::create([
            'book_id' => $book->id,
            'user_id' => Auth::id(),
            'reservation_date' => now(),
            'pickup_date' => $validated['pickup_date'],
            'quantity' => $validated['quantity'],
            'status' => 'pending'
        ]);

        // Update book stock
        $book->decrement('stock', $validated['quantity']);
        $book->updateStock();

        return redirect()->route('books.show', $book)
               ->with('success', 'Boek succesvol gereserveerd!');
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        // Return stock to book
        $book = $reservation->book;
        $book->increment('stock', $reservation->quantity);
        $book->updateStock();

        $reservation->delete();

        return redirect()->route('reservations.index')
               ->with('success', 'Reservatie geannuleerd');
    }
}
