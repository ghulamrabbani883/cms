<?php
include_once 'config.php';
$cid = $_GET['id'];
$sql = "DELETE FROM category WHERE cid=$cid";
$result = mysqli_query($conn,$sql);
if($result){
    header("Location:category.php");
}else{
    echo "query failed";
}
?>