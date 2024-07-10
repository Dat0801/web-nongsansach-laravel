<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    //

    public function index()
    {
        return view('client.auth.login')->with('title', 'Đăng nhập');
    }

    public function store(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $user['verify'] = true;
            $user['address'] = $user->defaultAddress->address;
            $user['province'] = $user->defaultAddress->province;
            $user['district'] = $user->defaultAddress->district;
            $user['ward'] = $user->defaultAddress->ward;
            Session::put('user', $user);
            return redirect()->route('profile');
        }
        return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng');
    }

    public function logout()
    {
        Auth::logout();
        if(Session::has('user')) {
            Session::forget('user');
        }
        return redirect()->route('login');
    }
}
