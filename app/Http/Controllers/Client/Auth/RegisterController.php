<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('client.auth.register')->with('title', 'Đăng ký');
    }

    public function verifyUser(RegisterRequest $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);
        session()->put('verify', false);
        $user = $request->except('_token', 'password_confirmation');
        $user['password'] = bcrypt($request->password);
        session()->put('user', $user);
        return $this->sendConfirmationEmail($request->email);
        
    }

    public function store($userData)
    {
        
        $user = User::create($userData);
        $user->addresses()->create([
            'address_type_id' => 1,
            'address' => $userData['address'],
            'province' => $userData['province'],
            'district' => $userData['district'],
            'ward' => $userData['ward'],
        ]);
        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công');
    }

    public function sendConfirmationEmail($email)
    {
        $verificationCode = Str::random(6);
        session()->put('verification_code', $verificationCode);
        Mail::to($email)->send(new VerificationEmail($verificationCode));
        return redirect()->route('register.verify.index');
    }

    public function getVerify()
    {
        return view('client.email.register-verify-email')->with('title', 'Xác thực email');
    }

    public function postVerify(Request $request)
    {
        $request->validate([
            'code' => 'required|size:6'
        ]);
        if ($request->code == session()->get('verification_code')) {
            session()->forget('verification_code');
            return $this->store(session()->get('user'));
        } else {
            return redirect()->back()->with('error', 'Mã xác thực không chính xác');
        }
    }

}
