<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login', [
            'title' => 'Đăng nhập'
        ]);
    }

    public function store(LoginRequest $request)
    {
        if (Auth::guard('employee')->attempt(['employee_email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        }
        Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('admin.login');
    }

}
