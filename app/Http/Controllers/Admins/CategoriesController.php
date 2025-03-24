<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('book')->paginate(10);

        return view('admins.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'name.max' => 'Tên danh mục quá dài'
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Thêm danh mục thành công');
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
        $category = Category::findOrFail($id);

        return view('admins.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255'
        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'name.max' => 'Tên danh mục quá dài'
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateCategoryStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->status = 0;
        $category->save();

        DB::table('books')
            ->whereIn('id', function ($query) use ($category) {
                $query->select('book_id')
                    ->from('book_category')
                    ->where('category_id', $category->id);
            })
            ->update(['status' => 0]);

        return redirect()->route('admin.categories')->with('success', 'Cập nhật trạng thái thành công!');
    }

    public function activateCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->status = 1;
        $category->save();

        DB::table('books')
            ->whereIn('id', function ($query) use ($category) {
                $query->select('book_id')
                    ->from('book_category')
                    ->where('category_id', $category->id);
            })
            ->update(['status' => 1]);

        return redirect()->route('admin.categories')->with('success', 'Kích hoạt danh mục và sản phẩm thành công!');
    }
}
