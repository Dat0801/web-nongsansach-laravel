<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Weight;
use App\Http\Requests\WeightRequest;


class WeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        //
        $weights = Weight::all();
        return view('admin.weight.index', compact('weights'))->with('title', 'Quản lý đơn vị trọng lượng');
    }

    /** 
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        //
        return view('admin.weight.create')->with('title', 'Thêm đơn vị trọng lượng');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(WeightRequest $request)
    {
        //
        $weight = new Weight();
        $weight->weight_name = $request->weight_name;
        $weight->save();
        return redirect()->route('weight.index')->with('success', 'Đơn vị trọng lượng đã được thêm thành công.');
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
        $weight = Weight::find($id);
        return view('admin.weight.edit', compact('weight'))->with('title', 'Cập nhật đơn vị trọng lượng');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     */
    public function update(WeightRequest $request, $id)
    {
        //
        $weight = Weight::find($id);
        $weight->weight_name = $request->weight_name;
        $weight->save();
        return redirect()->route('weight.index')->with('success', 'Đơn vị trọng lượng đã được cập nhật thành công.');
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
        $weight = Weight::find($id);
        $weight->delete();
        return redirect()->route('weight.index')->with('success', 'Đơn vị trọng lượng đã được xóa thành công.');
    }
}
