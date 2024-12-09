<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BooksToAuthors;


class BooksController extends Controller
{
    public function index(Request $request)
    {
        $author_id = $request->input('author_id');



        if (isset($author_id)) {
            $books_to_authors = BooksToAuthors::where('author_id', $author_id)->pluck('book_id')->toArray();
            $books = Book::whereIn('id', $books_to_authors)->get();
        } else $books = Book::all();

        return response()->json($books);
    }
}
