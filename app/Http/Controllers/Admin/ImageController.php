<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;
use App\Http\Requests\ImageRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        $images = Image::paginate(7);
        return view('admin.image.index', compact('images'))->with('title', 'Quản lý hình ảnh');
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        //
        $products = Product::all();
        return view('admin.image.create', compact('products'))->with('title', 'Thêm hình ảnh');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(Request $request)
    {
        //
        if ($request->hasFile('image_name')) {
            $image = $request->file('image_name');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('/assets/client/img/products/'), $imageName);
            $image = new Image();
            $image->image_name = $imageName;
            $image->product_id = $request->product_id;
            $image->is_primary = $request->is_primary;
            $image->save();
        } else {
            return redirect()->route('image.index')->with('error', 'Thêm hình ảnh thất bại.');
        }
        return redirect()->route('image.index')->with('success', 'Thêm hình ảnh thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * 
     */
    public function edit($id)
    {
        //
        $image = Image::find($id);
        $products = Product::all();
        return view('admin.image.edit', compact('image', 'products'))->with('title', 'Cập nhật hình ảnh');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     */
    public function update(Request $request, $id)
    {
        //
        $image = Image::find($id);
        if ($request->hasFile('image_name')) {
            $image_name = $request->file('image_name');
            $imageName = $image_name->getClientOriginalName();
            $image_name->move(public_path('/assets/client/img/products/'), $imageName);
            $image->image_name = $imageName;
        }
        $image->product_id = $request->product_id;
        $image->is_primary = $request->is_primary;
        $image->save();
        return redirect()->route('image.index')->with('success', 'Cập nhật hình ảnh thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     */
    public function destroy($id)
    {
        //
        $image = Image::find($id);
        $image->delete();
        return redirect()->route('image.index')->with('success', 'Xóa hình ảnh thành công.');
    }
}
