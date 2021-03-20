<?php
include_once 'config.php';
$pid = $_GET['id'];

$sql2 = "SELECT * FROM post WHERE pid = $pid";
$result2 = mysqli_query($conn,$sql2);
if(mysqli_num_rows($result2) > 0){
    $row2 = mysqli_fetch_assoc($result2);
}

unlink("upload/".$row2['post_image']);

$sql1 = "SELECT category FROM post WHERE pid = $pid";
$result1 = mysqli_query($conn,$sql1);
if(mysqli_num_rows($result1) > 0){
    while($row = mysqli_fetch_assoc($result1)){
        $cid =  $row['category'];
    }
}

$sql = "DELETE FROM post WHERE pid=$pid;";
$sql .= "UPDATE category SET post = post-1 WHERE cid = $cid";
$result = mysqli_multi_query($conn,$sql);
if($result){
    header("Location:post.php");
}else{
    echo "query failed";
}
?>