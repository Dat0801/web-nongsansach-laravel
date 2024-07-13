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
        $products = Product::all();
        return view('client.home.index', compact('products'))->with('title', 'Trang chủ');
    }
}
