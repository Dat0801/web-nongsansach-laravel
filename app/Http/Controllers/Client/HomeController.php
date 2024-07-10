<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    //
    public function index()
    {
        $products = Product::join('images', 'products.product_id', '=', 'images.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.category_id')
            ->join('weights', 'products.weight_id', '=', 'weights.weight_id')
            ->join('units', 'products.unit_id', '=', 'units.unit_id')
            ->select('products.*', 'images.image_name as image_name', 'categories.category_name as category_name', 'weights.weight_name as weight_name', 'units.unit_name as unit_name')
            ->where('images.is_primary', '=', '1')
            ->orderBy('product_id')
            ->get();
        return view('client.home.index', compact('products'))->with('title', 'Trang chủ');
    }
}
