<?php
include_once 'config.php';
$uid = $_GET['id'];
$sql = "DELETE FROM user WHERE uid=$uid";
$result = mysqli_query($conn,$sql);
if($result){
    header("Location:user.php");
}else{
    echo "query failed";
}
?>