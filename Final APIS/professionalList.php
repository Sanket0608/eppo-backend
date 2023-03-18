<?php
    include('db.php');
    $sqlRes=mysqli_query($con,"SELECT distinct(profession) from professional");
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