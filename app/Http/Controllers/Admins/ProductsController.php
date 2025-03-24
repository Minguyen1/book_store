<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('categories')->paginate(10);

        return view('admins.products.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();

        return view('admins.products.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'category' => 'required|exists:categories,id',
            'image' => 'required|max:2048',
            'price' => 'required|min:0',
            'quantity' => 'required|min:1'
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề sách',
            'title.max' => 'Tiêu đề quá dài',
            'author.required' => 'Vui lòng nhập tên tác giả',
            'author.max' => 'Tên quá dài',
            'category.required' => 'Vui lòng chọn thể loại',
            'category.exists' => 'Thể loại không hợp lệ',
            'image.required' => 'Vui lòng chọn ảnh',
            'image.max' => 'Kích thước ảnh quá lớn',
            'price.required' => 'Vui lòng nhập giá tiền',
            'price.min' => 'Giá phải lớn hơn 0',
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.min' => 'Số lượng phải lớn hơn 0'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
        } else {
            $imagePath = null;
        }

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'image' => $imagePath,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description
        ]);

        $book->categories()->attach($request->category);

        return redirect()->route('admin.products')->with('success', 'Thêm sách thành công');
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
        $book = Book::findOrFail($id);
        $category = Category::all();

        return view('admins.products.edit', compact('book', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'category' => 'required|exists:categories,id',
            'image' => 'nullable|max:2048',
            'price' => 'required|min:0',
            'quantity' => 'required|min:1'
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề sách',
            'title.max' => 'Tiêu đề quá dài',
            'author.required' => 'Vui lòng nhập tên tác giả',
            'author.max' => 'Tên quá dài',
            'category.required' => 'Vui lòng chọn thể loại',
            'category.exists' => 'Thể loại không hợp lệ',
            'image.max' => 'Kích thước ảnh quá lớn',
            'price.required' => 'Vui lòng nhập giá tiền',
            'price.min' => 'Giá phải lớn hơn 0',
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.min' => 'Số lượng phải lớn hơn 0'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $book->image);
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = $imagePath;
        }

        $book->update($data);

        $book->categories()->sync($request->category);

        return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->image) {
            Storage::delete('public/' . $book->image);
        }
        $book->delete();

        return redirect()->route('admin.products')->with('success', 'Xóa sản phẩm thành công');
    }
}
