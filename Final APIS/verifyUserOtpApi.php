<?php
include('db.php');
// Processing jason data
try {
    $data = json_decode(file_get_contents('php://input'), true);
    verifyOTP($data['phone'], $data['otp'], $data['name'], $data['password'], $data['address'], $data['email'], $data['city']);
    
} catch (\Throwable $th) {
    return 'failed';

}
function verifyOTP($phone, $otp, $name, $password, $address, $email, $city)
{
    include('db.php');
    $result = mysqli_query($con, "SELECT otp FROM otp WHERE mobile_no=$phone");
    $rows = mysqli_fetch_assoc($result);
    if ($otp == $rows['otp']) {
        $pass=md5($password);
        mysqli_query($con, "INSERT INTO user(user_name,email,mobile_no,city,address,password) VALUES ('$name','$email',$phone,'$city','$address','$pass')");
        // return "success";
        $status = array("Status"=>"success");
        echo json_encode($status);
    } else {
        $status = array("Status"=>"OTP not matched");
        echo json_encode($status);
    }

}
?>