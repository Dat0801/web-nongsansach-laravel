<?php

namespace App\Http\Controllers\Client;


use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Services\VNPayService;
use App\Mail\VerificationEmail;
use App\Mail\OrderSuccessEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CheckoutController extends Controller
{
    protected $vnpayService;
    //

    public function __construct(VNPayService $vnpayService)
    {
        $this->vnpayService = $vnpayService;
    }

    public function index()
    {
        return view('client.checkout.index')->with('title', 'Thanh toán');
    }

    public function verifyUser(CheckoutRequest $request)
    {
        if (!$request->has('payment_method')) {
            return redirect()->route('checkout');
        }
        session()->put('payment_method', $request->payment_method);
        if (isset(session()->get('user')['verify']) && session()->get('user')['verify'] == true && session()->get('user')['email'] == $request->email) {
            return redirect()->route('checkout.store');
        }
        $request->merge(['verify' => false]);
        session()->put('user', $request->except('payment_method'));
        return $this->sendConfirmationEmail($request->email);
    }

    public function sendConfirmationEmail($email)
    {
        $verificationCode = Str::random(6);
        session()->put('verification_code', $verificationCode);
        Mail::to($email)->send(new VerificationEmail($verificationCode));
        return redirect()->route('checkout.verify.index');
    }

    public function sendOrderSuccessEmail($email, $order)
    {
        Mail::to($email)->send(new OrderSuccessEmail($order));
    }

    public function checkVNPay(Request $request)
    {
        if ($request->vnp_ResponseCode == '00') {
            $order = Order::find($request->vnp_TxnRef);
            $order->status = 'Đã thanh toán';
            $order->save();
            $this->sendOrderSuccessEmail(session()->get('user')['email'], $order);
            return $this->success();
        } else {
            $order = Order::find($request->vnp_TxnRef);
            $order->status = 'Giao dịch thất bại';
            $order->save();
            return $this->failVNPay();
        }
    }

    public function store()
    {
        if (session()->get('user')['verify'] == false) {
            return redirect()->route('verify.index')->with('error', 'Vui lòng xác thực email trước khi thanh toán');
        }
        $user = $this->storeUser();
        $payment_method = session()->get('payment_method');
        $order = $this->storeOrder($user->user_id, $payment_method);
        $this->storeOrderDetail($order);
        
        if ($payment_method == 'cod') {
            $this->sendOrderSuccessEmail(session()->get('user')['email'], $order);
            return $this->success();
        } else if ($payment_method == 'vnpay') {
            $this->vnpayService->vnpayPayment($order->order_id, $order->order_total, $payment_method);
        }
    }

    public function getVerify()
    {
        return view('client.email.verify')->with('title', 'Xác thực email');
    }

    public function postVerify(Request $request)
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

    public function storeUser()
    {
        $userData = session()->get('user');
        $user = User::where('email', $userData['email'])->first();
        if ($user) {
            $user->update([
                'name' => $userData['name'],
                'phone_number' => $userData['phone_number'],
            ]);
            $user->defaultAddress->update([
                'address' => $userData['address'],
                'province' => $userData['province'],
                'district' => $userData['district'],
                'ward' => $userData['ward'],
            ]);

        } else {
            if (isset($userData['password'])) {
                $userData['password'] = bcrypt($userData['password']);
            }
            $user = User::create($userData);
            $user->addresses()->create([
                'address_type_id' => 1,
                'address' => $userData['address'],
                'province' => $userData['province'],
                'district' => $userData['district'],
                'ward' => $userData['ward'],
            ]);
        }
        return $user;
    }

    public function storeOrder($user_id, $payment_method)
    {
        $order = Order::create([
            'user_id' => $user_id,
            'payment_method' => $payment_method,
            'status' => 'Đang xử lý',
        ]);
        return $order;
    }

    public function storeOrderDetail($order)
    {
        $total = 0;
        foreach (session()->get('cart') as $key => $item) {
            $total += $item['quantity'] * $item['price'];
            $orderDetail = new OrderDetail([
                'order_id' => $order->order_id,
                'product_id' => $key,
                'quantity' => $item['quantity'],
                'total' => $item['quantity'] * $item['price'],
            ]);
            $orderDetail->save();
        }
        $order->order_total = $total;
        $order->save();
        session()->forget('cart');
        session()->forget('payment_method');
    }

    public function success()
    {
        session()->forget('cart');
        session()->forget('payment_method');
        return view('client.checkout.success')->with('title', 'Đặt hàng thành công');
    }

    public function failVNPay()
    {
        session()->forget('cart');
        session()->forget('payment_method');
        $title = 'Giao dịch thất bại';
        return view('client.checkout.fail-vnpay', compact('title'));
    }
}
