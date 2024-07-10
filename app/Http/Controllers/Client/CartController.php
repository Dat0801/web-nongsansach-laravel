<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class CartController extends Controller
{
    //
    public function index()
    {
        return view('client.cart.index')->with('title', 'Giỏ hàng');
    }

    public function addToCartAjax($id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->product_name,
                'price' => $product->product_price,
                'unit' => $product->unit->unit_name,
                'weight_quantity' => $product->product_quantity,
                'weight_name' => $product->weight->weight_name,
                'quantity' => 1,
                'stock' => $product->product_stock,
                'image' => $product->primaryImage->image_name
            ];
        }
        session()->put('cart', $cart);
        return response()->json(['msg' => 'success']);
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $cart = session()->get('cart');
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $cart[$request->id]['quantity'] + $request->quantity;
        } else {
            $cart[$request->id] = [
                'name' => $product->product_name,
                'price' => $product->product_price,
                'unit' => $product->unit->unit_name,
                'weight_quantity' => $product->product_quantity,
                'weight_name' => $product->weight->weight_name,
                'quantity' => $request->quantity,
                'stock' => $product->product_stock,
                'image' => $product->primaryImage->image_name
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart');
        $cart[$request->id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
        return response()->json(['msg' => 'success']);
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        return response()->json(['msg' => 'success']);
    }

    public function emptyCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Xóa giỏ hàng thành công');
    }

    public function cartBadge()
    {
        return view('client.cart.cart-badge');
    }

    public function cartTable()
    {
        return view('client.cart.cart-table');
    }
}
