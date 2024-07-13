<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * đơn hàng
     */
    public function index()
    {
        //
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.order.index', compact('orders'))->with('title', 'Danh sách đơn hàng');
    }

    /**
     * Show the form for creating a new resource.
     *
     * đơn hàng
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * đơn hàng
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * đơn hàng
     */
    public function show($id)
    {
        //
        $order = Order::find($id);
        return view('admin.order.show', compact('order'))->with('title', 'Chi tiết đơn hàng');
    }

    public function accept($id)
    {
        $order = Order::find($id);
        $order->status = 'Đang giao hàng';
        $order->save();
        return redirect()->back()->with('success', 'Đã chấp nhận đơn hàng');
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $order->status = 'Đã hủy';
        $order->save();
        return redirect()->back()->with('success', 'Đã hủy đơn hàng');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * đơn hàng
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * đơn hàng
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * đơn hàng
     */
    public function destroy($id)
    {
        //
    }
}
