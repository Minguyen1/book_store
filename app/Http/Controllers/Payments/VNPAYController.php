<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VNPayController extends Controller
{
    public function createPayment(Request $request)
    {
        $vnp_TmnCode    = config('vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_Url        = config('vnpay.vnp_Url');
        $vnp_ReturnUrl  = config('vnpay.vnp_ReturnUrl');

        $vnp_TxnRef = time();
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = request()->ip();

        $inputData = [
            "vnp_Version"    => "2.1.0",
            "vnp_Command"    => "pay",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => $vnp_Amount,
            "vnp_CurrCode"   => "VND",
            "vnp_TxnRef"     => $vnp_TxnRef,
            "vnp_OrderInfo"  => "Thanh toán đơn hàng " . $vnp_TxnRef,
            "vnp_OrderType"  => "billpayment",
            "vnp_Locale"     => $vnp_Locale,
            "vnp_ReturnUrl"  => $vnp_ReturnUrl,
            "vnp_IpAddr"     => $vnp_IpAddr
        ];

        // Tạo URL thanh toán
        ksort($inputData);
        $query = "";
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            $query .= urlencode($key) . "=" . urlencode($value) . "&";
            $hashdata .= $key . "=" . $value . "&";
        }

        $query = rtrim($query, "&");
        $hashdata = rtrim($hashdata, "&");

        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= "?" . $query . "&vnp_SecureHash=" . $vnpSecureHash;

        return redirect($vnp_Url);
    }

    public function returnPayment(Request $request)
    {
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $inputData = $request->all();

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);

        ksort($inputData);
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            $hashdata .= $key . "=" . $value . "&";
        }
        $hashdata = rtrim($hashdata, "&");

        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == "00") {
                return redirect()->route('home')->with('success', 'Thanh toán thành công');
            } else {
                return redirect()->route('home')->with('error', 'Thanh toán thất bại');
            }
        }
        return redirect()->route('home')->with('error', 'Xác thực giao dịch thất bại');
    }
}
