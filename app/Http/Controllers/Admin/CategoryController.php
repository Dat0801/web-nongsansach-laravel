<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'))->with('title', 'Quản lý danh mục');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
        return view('admin.category.create')->with('title', 'Thêm danh mục');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CategoryRequest $request)
    {
        //
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        return redirect()->route('category.index')->with('success', 'Danh mục đã được thêm thành công.');     
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'))->with('title', 'Sửa danh mục');
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(CategoryRequest $request, $id)
    {
        //
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->save();
        return redirect()->route('category.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
