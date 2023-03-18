<?php
include('db.php');
// Processing jason data
try {
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    $password = $data['password'];
    $address = $data['address'];
    $email = $data['email'];
    $city = $data['city'];
    $phone = $data['phone'];
    $otp = $data['otp'];

    verifyOTP($phone, $otp, $name, $password, $address, $email, $city);
    
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
        return "success";
    } else {
        return "otp not matched";
    }

}
?>