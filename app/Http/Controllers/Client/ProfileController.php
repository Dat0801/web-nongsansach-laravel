<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index() {
        $orders = auth()->user()->orders;
        return view('client.profile.index', compact('orders'))->with('title', 'Thông tin tài khoản');
    }
}
