<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function index() {
        return view('client.auth.register')->with('title', 'Đăng ký');
    }
}
