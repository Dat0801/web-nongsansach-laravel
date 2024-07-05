<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        //
        $units = Unit::all();
        return view('admin.unit.index', compact('units'))->with('title', 'Quản lý đơn vị tính');
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        //
        return view('admin.unit.create')->with('title', 'Thêm đơn vị tính');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(UnitRequest $request)
    {
        //
        $unit = new Unit();
        $unit->unit_name = $request->unit_name;
        $unit->save();
        return redirect()->route('unit.index')->with('success', 'Đơn vị tính đã được thêm thành công.');
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
        $unit = Unit::find($id);
        return view('admin.unit.edit', compact('unit'))->with('title', 'Sửa đơn vị tính');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     */
    public function update(UnitRequest $request, $id)
    {
        //
        $unit = Unit::find($id);
        $unit->unit_name = $request->unit_name;
        $unit->save();
        return redirect()->route('unit.index')->with('success', 'Đơn vị tính đã được cập nhật thành công.');
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
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->route('unit.index')->with('success', 'Đơn vị tính đã được xóa thành công.');
    }
}
