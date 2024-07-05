<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Weight;
use App\Models\Unit;
use App\Models\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        //
        $products = Product::join('categories', 'products.category_id', '=', 'categories.category_id')
            ->join('weights', 'products.weight_id', '=', 'weights.weight_id')
            ->join('units', 'products.unit_id', '=', 'units.unit_id')
            ->select('products.*', 'categories.category_name', 'weights.weight_name', 'units.unit_name')
            ->where('products.status', '=', '1')
            ->orderBy('product_id')
            ->paginate(7);
        return view('admin.product.index', compact('products'))->with('title', 'Quản lý sản phẩm');
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        //
        $categories = Category::paginate();
        $weights = Weight::all();
        $units = Unit::all();
        return view('admin.product.create', compact('categories', 'weights', 'units'))->with('title', 'Thêm sản phẩm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(ProductRequest $request)
    {
        //
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;
        $product->weight_id = $request->weight_id;
        $product->product_stock = $request->product_stock;
        $product->product_quantity = $request->product_quantity;
        $product->save();

        if ($request->hasFile('primary_img_name')) {
            $image = $request->file('primary_img_name');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('/assets/client/img/products/'), $imageName);
            $image = new Image();
            $image->image_name = $imageName;
            $image->product_id = $product->product_id;
            $image->is_primary = 1;
            $image->save();
        }

        if ($request->hasFile('secondary_img_name')) {
            $images = $request->file('secondary_img_name');
            $imageNames = [];
            foreach ($images as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('/assets/client/img/products/'), $imageName);
                $imageNames[] = $imageName;
            }
            foreach ($imageNames as $imageName) {
                $image = new Image();
                $image->image_name = $imageName;
                $image->product_id = $product->product_id;
                $image->is_primary = 0;
                $image->save();
            }
        }
        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được thêm thành công.');
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
        $product = Product::find($id);
        $categories = Category::all();
        $weights = Weight::all();
        $units = Unit::all();
        $images = Image::all();
        return view('admin.product.edit', compact('product', 'categories', 'weights', 'units', 'images'))->with('title', 'Cập nhật sản phẩm');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     */
    public function update(ProductRequest $request, $id)
    {
        //
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;
        $product->weight_id = $request->weight_id;
        $product->product_stock = $request->product_stock;
        $product->product_quantity = $request->product_quantity;
        $product->save();
        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
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
        $product = Product::find($id);
        $product->status = 0;
        $product->save();
        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }

    public function trash()
    {
        $products = Product::join('categories', 'products.category_id', '=', 'categories.category_id')
            ->join('weights', 'products.weight_id', '=', 'weights.weight_id')
            ->join('units', 'products.unit_id', '=', 'units.unit_id')
            ->select('products.*', 'categories.category_name', 'weights.weight_name', 'units.unit_name')
            ->where('products.status', '=', '0')
            ->orderBy('product_id')
            ->paginate(7);
        return view('admin.product.trash', compact('products'))->with('title', 'Thùng rác sản phẩm');
    }

    public function restore($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $product->save();
        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được khôi phục thành công.');
    }
}
