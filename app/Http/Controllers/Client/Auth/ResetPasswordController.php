<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    //
    public function index()
    {
        return view('client.auth.reset-password')->with(['title' => 'Đổi mật khẩu']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ], [
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'confirm_password.required' => 'Xác nhận mật khẩu không được để trống',
            'confirm_password.same' => 'Xác nhận mật khẩu không khớp'
        ]);
        $user = User::where('email', session()->get('user')['email'])->first();
        $user->password = bcrypt($request->password);
        $user->save();
        session()->forget('user');
        return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công');
    }
}
