<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    // Display the borrowers page
    public function index()
{
    // Fetch only borrowers with no return_date (active borrows)
    $borrowers = Borrower::with('book')->whereNull('return_date')->get();
    return view('CET.inventory.book.borrowers-book', compact('borrowers'));
}

public function history()
{
    // Fetch all returned books
    $history = Borrower::with('book')->whereNotNull('return_date')->get();
    return view('CET.inventory.book.borrowers-history', compact('history'));
}


    // Store a borrower (borrow a book)
public function store(Request $request)
{
    $validated = $request->validate([
        'book_id' => 'required|exists:books,id',
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'student_id' => 'required|string|max:50',
        'borrow_date' => 'required|date',
    ]);

    // Check if the student has an unreturned book
    $existingBorrow = Borrower::where('student_id', $validated['student_id'])
        ->whereNull('return_date')
        ->first();

    if ($existingBorrow) {
        return redirect()->back()->with('error', 'This student has not returned their previous book.');
    }

    // Borrow the book
    Borrower::create($validated);
    $book = Book::find($validated['book_id']);
    $book->status = 'borrowed';
    $book->save();

    return redirect()->route('CET.inventory.borrowers.index')->with('success', 'Book borrowed successfully!');
}

// Mark a book as returned and set the return date
public function setReturn(Request $request, $id)
{
    $request->validate([
        'return_date' => 'required|date',
    ]);

    $borrower = Borrower::findOrFail($id);

    // Set the return date and status
    $borrower->return_date = $request->return_date;
    $borrower->status = 'returned';
    $borrower->save();

    // Update the book status to available
    $book = $borrower->book;
    $book->status = 'available';
    $book->save();

    return redirect()->route('CET.inventory.borrowers.index')->with('success', 'Return date set successfully!');
}


}

