<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use App\Http\Controllers\User\PurchaseHistoryController;


class PaymentController extends Controller
{
    protected $PurchaseHistoryController;
    protected $OrderController;

    public function __construct(
        PurchaseHistoryController $PurchaseHistoryController,
        OrderController $OrderController
    ) {
        $this->PurchaseHistoryController = $PurchaseHistoryController;
        $this->OrderController = $OrderController;
    }

    // Thanh toán qua VNPAY
    public function vnpay_payment(Request $request)
    {
        $orderID = $request->input('orderID');
        $totalPrice = $request->input('totalPrice');


        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "COITO8B1"; //Mã website tại VNPAY
        $vnp_HashSecret = "NOZZACDLIXEBGNPEDSNEHAIWBQALWLLM"; //Chuỗi bí mật

        $vnp_TxnRef = $request->input('orderID'); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán đơn hàng #" . $vnp_TxnRef;
        $vnp_OrderType = "PING SHOP";
        $vnp_Amount = $request->input('totalPrice') * 100;
        $vnp_Locale = "vn";
        //        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        ////Add Params of 2.0.1 Version
//        $vnp_ExpireDate = $_POST['txtexpire'];
////Billing
//        $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
//        $vnp_Bill_Email = $_POST['txt_billing_email'];
//        $fullName = trim($_POST['txt_billing_fullname']);
//        if (isset($fullName) && trim($fullName) != '') {
//            $name = explode(' ', $fullName);
//            $vnp_Bill_FirstName = array_shift($name);
//            $vnp_Bill_LastName = array_pop($name);
//        }
//        $vnp_Bill_Address = $_POST['txt_inv_addr1'];
//        $vnp_Bill_City = $_POST['txt_bill_city'];
//        $vnp_Bill_Country = $_POST['txt_bill_country'];
//        $vnp_Bill_State = $_POST['txt_bill_state'];
//// Invoice
//        $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
//        $vnp_Inv_Email = $_POST['txt_inv_email'];
//        $vnp_Inv_Customer = $_POST['txt_inv_customer'];
//        $vnp_Inv_Address = $_POST['txt_inv_addr1'];
//        $vnp_Inv_Company = $_POST['txt_inv_company'];
//        $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
//        $vnp_Inv_Type = $_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
            //            "vnp_ExpireDate" => $vnp_ExpireDate,
//            "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
//            "vnp_Bill_Email" => $vnp_Bill_Email,
//            "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
//            "vnp_Bill_LastName" => $vnp_Bill_LastName,
//            "vnp_Bill_Address" => $vnp_Bill_Address,
//            "vnp_Bill_City" => $vnp_Bill_City,
//            "vnp_Bill_Country" => $vnp_Bill_Country,
//            "vnp_Inv_Phone" => $vnp_Inv_Phone,
//            "vnp_Inv_Email" => $vnp_Inv_Email,
//            "vnp_Inv_Customer" => $vnp_Inv_Customer,
//            "vnp_Inv_Address" => $vnp_Inv_Address,
//            "vnp_Inv_Company" => $vnp_Inv_Company,
//            "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
//            "vnp_Inv_Type" => $vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
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

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
        );
        //        if (isset($_POST['redirect'])) {
//            header('Location: ' . $vnp_Url);
//            die();
//        } else {
//            echo json_encode($returnData);
//        }
        return response()->json($returnData);
        // vui lòng tham khảo thêm tại code demo
    }

    public function VnpayReturn(Request $request)
    {
        //        dd($request->vnp_ResponseCode .' ' .gettype($request->vnp_ResponseCode));
        $vnp_ResponseCode = $request->vnp_ResponseCode;
        $vnp_TxnRef = $request->vnp_TxnRef;
        $vnp_Amount = $request->vnp_Amount;
        if ($vnp_ResponseCode == "00") {
            $paymentStatus = 'paid';
            $this->OrderController->UpdatePaymentMethod($vnp_TxnRef, "VNPAY");
            $this->PurchaseHistoryController->storePurchaseHistory($vnp_TxnRef, $vnp_Amount/100, 'VNPAY');
            $this->OrderController->UpdatePaymentStatusPaid($vnp_TxnRef, $paymentStatus);
            return redirect()->route('order.success', ['orderID' => $vnp_TxnRef]);
        } else {
            $paymentStatus = 'unpaid';
            $this->OrderController->UpdatePaymentStatusPaid($vnp_TxnRef, $paymentStatus);
            $this->OrderController->UpdatePaymentMethod($vnp_TxnRef, "COD");
            return redirect()->route('order.success', ['orderID' => $vnp_TxnRef, 'isError' => "true"]);
        }
    }

    // Thanh toán qua MOMO
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo_payment(Request $request)
    {
        $orderID = $request->input('orderID');
        $totalPrice = $request->input('totalPrice');


        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        // $partnerCode = 'MOMOBKUN20180529';
        $partnerCode = 'MOMO';
        // $accessKey = 'klm05TvNBzhg7h7j';
        $accessKey = 'F8BBA842ECF85';
        // $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $secretKey = 'K951B6PE1waDMi640xX08PD3vg6EkVlz';

        $orderInfo = "Thanh toán đơn hàng " . $orderID . ' tại PING Shop';
        $amount = $totalPrice;
        $orderId = $orderID;
        // $redirectUrl = "http://127.0.0.1:8000/order-success/" . $orderID;
        $redirectUrl = route("momo.redirect");
        $ipnUrl = "http://127.0.0.1:8000/order-success/" . $orderID;
        $extraData = "";


        if (!empty($_POST)) {
            $partnerCode = $partnerCode;
            $accessKey = $accessKey;
            $serectkey = $secretKey;

            $orderId = $orderId; // Mã đơn hàng
            $orderInfo = $orderInfo;
            $amount = $totalPrice;
            $ipnUrl = $ipnUrl;
            $redirectUrl = $redirectUrl;
            $extraData = $extraData;

            $requestId = time() . "";
            // $requestType = "payWithATM";
            // $requestType = "captureWallet";
            $requestType = "payWithMethod";
            //$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $serectkey);
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "PING Shop",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
            $url = $jsonResult['payUrl'];

            //Just a example, please check more in there
            return response()->json(['code' => '00', 'message' => 'success', 'data' => $url]);
        }
    }


    public function redirectMomoPayment(Request $request)
    {
        if ($request->resultCode == '0') {
            $paymentStatus = 'paid';
            $this->OrderController->UpdatePaymentMethod($request->orderId, "MOMO");
            $this->PurchaseHistoryController->storePurchaseHistory($request->orderId, $request->amount, 'MOMO');
            $this->OrderController->UpdatePaymentStatusPaid($request->orderId, $paymentStatus);
            return redirect()->route('order.success', ['orderID' => $request->orderId]);
        } else {
            $paymentStatus = 'unpaid';
            $this->OrderController->UpdatePaymentMethod($request->orderId, "COD");
            $this->OrderController->UpdatePaymentStatusPaid($request->orderId, $paymentStatus);
            return redirect()->route('order.success', ['orderID' => $request->orderId, 'isError' => "true"]);
        }
    }
}
