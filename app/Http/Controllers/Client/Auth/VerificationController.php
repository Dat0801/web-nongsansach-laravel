<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    //
    public function index()
    {
        if (session()->get('user')['email'] == null) {
            return redirect()->back();
        }
        return view('client.email.verify')->with('title', 'Xác thực email');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|size:6'
        ]);
        if ($request->code == session()->get('verification_code')) {
            $user = session()->get('user');
            $user['verify'] = true;
            session()->put('user', $user);
            session()->forget('verification_code');
            return redirect()->route('checkout.processPayment');
        } else {
            return redirect()->back()->with('error', 'Mã xác thực không chính xác');
        }
    }
}
