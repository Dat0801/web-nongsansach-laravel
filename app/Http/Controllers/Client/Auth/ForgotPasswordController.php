<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    //
    public function index()
    {
        return view('client.auth.forgot-password')->with(['title' => 'Quên mật khẩu']);
    }

    public function verifyUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng'
        ]);

        $user = User::where('email', $request->email)->first();
        $user['verify'] = false;
        session()->put('user', $user);
        if (!$user) {
            return redirect()->back()->with('error', 'Email không tồn tại');
        }
        $this->sendMail($request->email);
        return redirect()->route('forgotPassword.verify.index');
    }

    public function sendMail($email)
    {
        $verificationCode = Str::random(6);
        session()->put('verification_code', $verificationCode);
        Mail::to($email)->send(new VerificationEmail($verificationCode));
    }

    public function verify()
    {
        return view('client.auth.verify-forgot-password')->with(['title' => 'Xác thực email']);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);
        if ($request->code == session()->get('verification_code')) {
            session()->forget('verification_code');
            session()->get('user')['verify'] = true;
            return redirect()->route('resetPassword.index');
        }
        return redirect()->back()->with('error', 'Mã xác nhận không chính xác');
    }
}
