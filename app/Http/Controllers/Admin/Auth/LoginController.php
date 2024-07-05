<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login', [
            'title' => 'Đăng nhập'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email là bắt buộc',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Password là bắt buộc'
            ]   
        );
        
        if (Auth::guard('employee')->attempt(['employee_email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            return redirect()->route('admin.dashboard');

        }

        Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng');
        return redirect()->back();
    }

}
