<!-- Get list of professionals belongs to same profession  -->
<?php
include('db.php');
$data = json_decode(file_get_contents('php://input'), true);
$profession=$data['profession'];
$sqlRes = mysqli_query($con, "SELECT * FROM professional WHERE profession='$profession'");
if(mysqli_num_rows($sqlRes)>0){
    $data=[];
    while($row=mysqli_fetch_assoc($sqlRes)){
        $data[]=$row;
    }
    $status='true';
    $code='5';
}else{
    $status='true';
    $data="Data not found";
    $code='4';
}
echo json_encode(["status"=>$status,"data"=>$data,"code"=>$code]);


?>