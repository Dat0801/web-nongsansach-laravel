<?php

namespace App\Http\Services;

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');
class VNPayService
{
    protected $vnp_Url;
    protected $vnp_TmnCode;
    protected $vnp_HashSecret;
    protected $vnp_Returnurl;

    public function __construct()
    {
        $this->vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL của VNPAY
        $this->vnp_TmnCode = "262XSFHX"; // Mã website tại VNPAY
        $this->vnp_HashSecret = "MMZXWISZNUUUNKGOZQPCPASLLTHYGMTB"; // Chuỗi bí mật
        $this->vnp_Returnurl = route('checkout.checkVnpay'); // URL trả về sau khi thanh toán (cần điều chỉnh theo logic của bạn)
    }

    public function vnpayPayment($order_id, $order_total, $payment_method)
    {
        $vnp_TxnRef = $order_id; // Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $order_id;
        $vnp_OrderType = '250000';
        $vnp_Amount = $order_total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $this->vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_BankCode" => $vnp_BankCode, 
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->vnp_Url . "?" . $query;

        if (isset($this->vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $this->vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
       
        if ($payment_method == 'vnpay') {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
