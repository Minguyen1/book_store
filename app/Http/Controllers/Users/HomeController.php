<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('categories')->paginate(12);

        $categories = Category::all();

        return view('users.home', compact('books', 'categories'));
    }

    public function detail(string $id){
        $book = Book::with('categories')->findOrFail($id);

        return view('users.detail', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function category($id)
    {
        $category = Category::where('id', $id)->firstOrFail();

        $books = $category->book()->paginate(12);

        return view('users.category', compact('category', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
