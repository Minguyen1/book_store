<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class SearchsController extends Controller
{
    public function search(Request $request){
        $query = $request->input('query');

        $books = Book::where('title', 'LIKE', "%$query%")
                        ->orWhere('author', 'LIKE', "%$query%")
                        ->paginate(12);

        return view('users.search', compact('books', 'query'));
    }
}
