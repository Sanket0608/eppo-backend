<?php
// API to verify professional
include('db.php');
// Processing jason data
try {
    $data = json_decode(file_get_contents('php://input'), true);
    verifyOTP($data['name'],$data['password'],$data['email'],$data['mobile_no'],$data['profession'],$data['city'],$data['address'],$data['rating'],$data['experience'],$data['availability'],$data['about'],$data['price']);
} catch (\Throwable $th) {
    return 'failed';

}
function verifyOTP($name,$password,$email,$mobile_no,$profession,$city,$address,$rating,$experience,$availability,$about,$price)
{
    include('db.php');
    $result = mysqli_query($con, "SELECT otp FROM otp WHERE mobile_no=$mobile_no");
    $rows = mysqli_fetch_assoc($result);
    if ($otp == $rows['otp']) {
        $pass=password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($con, "INSERT INTO professional(name,password,email,mobile_no,profession,city,address,rating,experience,availability,about,price) VALUES ('$name','$password','$email',$mobile_no,'$profession','$city','$address',$rating,'$experience',$availability,'$about',$price)");
        $status = array("Status"=>"success");
        return json_encode($status);
    } else {
        $status = array("Status"=>"failed");
        return json_encode($status);
    }
}
?>