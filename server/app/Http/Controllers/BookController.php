<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function all() {
        $booksArr = Book::all();
        return $booksArr;
    }
    public function add(Request $request) {
        $book = new Book;
        $book->title = $request->post('title');
        $book->author = $request->post('author');
        $book->availability = true;
        $book->save();

        return response(null, 201);
    }
    public function delete($id) {
        $book = Book::findOrFail($id);
        $book->delete();
        return response(null, 200);
    }
    public function changeAvailabilty($id) {
        $book = Book::findOrFail($id);
        $book->availability = !$book->availability;
        $book->save();
        return response(null, 200);
    }
}
