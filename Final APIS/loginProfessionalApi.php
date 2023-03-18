<?php
include('db.php');
$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'];
$password = $data['password'];
$res = mysqli_query($con, "SELECT * from professional where name='$name'");
$check = mysqli_num_rows($res);
$row = mysqli_fetch_assoc($res);
// print_r($row['user_name']);
// echo $check;
if ($check > 0) {
    // $verify = password_verify($password, $row['password']);
    // echo $verify;
    if (md5($data['password'])==$row['password']) {
        // echo 'Correct Password!';
        $status = array("Status"=>"Correct Password");
        echo json_encode($status);
    } else {
        // echo 'Password is Incorrect';
        $status = array("Status"=>"Invalid Password");
        echo json_encode($status);
    }
} else {
    // echo "Invalid Username or Passsword";
    $status = array("Status"=>"Invalid Username or Password");
        echo json_encode($status);
}
// $con->close();
?>