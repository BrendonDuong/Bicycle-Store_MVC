<?php
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}


$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Payment for orders MoMo";
$amount = $_POST['total_paymentgateways'] * 2300000;
$orderId = time() ."";
$redirectUrl = "http://localhost/Bicycle%20Store_MVC/success.php";
$ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
$extraData = "";



    $partnerCode = $partnerCode;
    $accessKey = $accessKey;
    $serectkey = $secretKey;
    $orderId = time(); // Mã đơn hàng
    $orderInfo = 'Payment for orders MoMo by QR Code';
    $amount = $amount;
    // $ipnUrl = $_POST["ipnUrl"];
    $redirectUrl = $redirectUrl;
    $extraData = $extraData;

    $requestId = time() . "";
    if (isset($_POST['captureWallet'])) {
        $requestType = "captureWallet";
    }else{
        $requestType = "payWithATM";
    }
    // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
    //before sign HMAC SHA256 signature
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $serectkey);
    $data = array('partnerCode' => $partnerCode,
        'partnerName' => "Test",
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
        'signature' => $signature);
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);  // decode json

    //Just a example, please check more in there

    header('Location: ' . $jsonResult['payUrl']);
// }elseif (isset($_POST['payWithATM'])) {

//     $partnerCode = $partnerCode;
//     $accessKey = $accessKey;
//     $serectkey = $secretKey;
//     $orderId = time(); // Mã đơn hàng
//     $orderInfo = 'Payment for orders MoMo by ATM Code';
//     $amount = $amount;
//     // $ipnUrl = $_POST["ipnUrl"];
//     $redirectUrl = $redirectUrl;
//     $extraData = $extraData;

//     $requestId = time()."";
    

//     // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
//     //before sign HMAC SHA256 signature
//     $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
//     $signature = hash_hmac("sha256", $rawHash, $serectkey);
//     $data = array('partnerCode' => $partnerCode,
//         'partnerName' => "Test",
//         "storeId" => "MomoTestStore",
//         'requestId' => $requestId,
//         'amount' => $amount,
//         'orderId' => $orderId,
//         'orderInfo' => $orderInfo,
//         'redirectUrl' => $redirectUrl,
//         'ipnUrl' => $ipnUrl,
//         'lang' => 'vi',
//         'extraData' => $extraData,
//         'requestType' => $requestType,
//         'signature' => $signature);
//     $result = execPostRequest($endpoint, json_encode($data));
//     $jsonResult = json_decode($result, true);  // decode json

//     //Just a example, please check more in there

//     header('Location: ' . $jsonResult['payUrl']);
// }

// partnerCode=MOMOBKUN20180529&
// orderId=1679120732&
// requestId=1679120732&
// amount=11000&
// orderInfo=Payment+for+orders+MoMo+by+QR+Code&
// orderType=momo_wallet&
// transId=2937203908&resultCode=0&
// message=Successful.&
// payType=napas&
// responseTime=1679120796848&
// extraData=&
// signature=94d9d0a9b19bf092dfed8c307bd86276789b97b0ab38377e8d890508df4c2096
?>