<?php
include('db.php');
$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'];
$password = $data['password'];
$res = mysqli_query($con, "SELECT * from user where user_name='$name'");
$check = mysqli_num_rows($res);
$row=mysqli_fetch_assoc($res);
// print_r($row['user_name']);
echo $check;
if ($check > 0) {
    // echo "if entered";
    $verify = password_verify($password, $row['password']);
    echo $verify;
    // echo "Here I am";
    if ($verify != 1) {
        echo "Invalid Password";
    } else {
        echo "Password Matched";
    }

} else {
    echo "Invalid Username or Passsword";
}
// $con->close();
?>