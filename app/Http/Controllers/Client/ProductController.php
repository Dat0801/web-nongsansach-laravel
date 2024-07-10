<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $category_id = $request->category_id;
        if ($category_id) {
            $products = Product::where('category_id', $category_id)->paginate(6);
        } else {
            $products = Product::paginate(6);
        }
        $categories = Category::withCount('products')->get();
        return view('client.product.index', compact('products', 'categories', 'category_id'))->with('title', 'Sản phẩm');
    }

    public function show($id)
    {
        $product = Product::find($id);
        $productsByCategory = Product::where('category_id', $product->category_id)->get();
        return view('client.product.show', compact('product', 'productsByCategory'))->with('title', 'Chi tiết sản phẩm');
    }

}
