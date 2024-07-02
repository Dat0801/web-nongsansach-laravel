<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login', [
            'title' => 'Đăng nhập'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email là bắt buộc',
                'password.required' => 'Password là bắt buộc'
            ]
        );

        if (
            Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ], $request->input('remember'))
        ) {
            return redirect()->route('admin.dashboard');
        }

        Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng');
        return redirect()->back();
    }

}
