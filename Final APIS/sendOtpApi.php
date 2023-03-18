<?php
try {
    $data = json_decode(file_get_contents('php://input'), true);
    $phone = $data['phone'];
    SendOTP($phone);
} catch (\Throwable $th) {
    return 'failed';

}
function SendOTP($phone)
{
    include('db.php');
    $otp = rand(0000, 9999);
    $fields = array(
        "variables_values" => $otp,
        "route" => "otp",
        "numbers" => $phone,
        // "numbers" => "9999999999,8888888888,7777777777",
    );


    $curl = curl_init();
    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization: gQJ4d09tEbC8zw3ARNyxViTeSLYpBhWsGOlcf27aPU1FmDIrn6eSFdwJnGMKkRZIm0ls8L7hWOQBP1jT",
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        )
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
        // mysqli_query($con, "INSERT INTO user(user_name,email,mobile_no,city,address,password) VALUES ('$name','$email',$phone,'$city','$address','$password')");
        mysqli_query($con, "INSERT into otp(mobile_no,otp) values('$phone','$otp')");
        // verifyOTP($phone,$otp, $name, $password, $address, $email, $city);
    }

}
?>