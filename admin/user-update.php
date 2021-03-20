<?php
include_once 'config.php';
session_start();
if(!isset($_SESSION['username'])){
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEws site</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   <div class="nav">
       <div class="logo">
           <img src="images/concept-fake-news.jpg" alt="LOGO" width="200px" height="50px">
       </div>
       <ul class="menu">
           <li><a href="#">Politics</a></li>
           <li><a href="#">Sports</a></li>
           <li><a href="#">Health</a></li>
           <li><a href="#">Technology</a></li>
           <li><a href="#">Business</a></li>
           
       </ul>
   </div>
   <?php 
    if($_SESSION['role'] == 'normal-user'){
        header("Location:post.php");
    }
    ?>
   <div class="admin-pages">
       <<?php
                
                if(isset($_SESSION['username']) && isset($_SESSION['password'])){
                ?>
                    <h3><a href="post.php">Post</a></h3>
                    <h3><a href="category.php">Category</a></h3>
                    <h3><a href="user.php">Users</a></h3>
                    <button type="button"><a href="add-post.php">Add New Post</a></button>
                    <h3><a href='logout.php'>Logout</a></h3>
                <?php    
                }else{
                ?>
                    <h3><a href="post.php">Post</a></h3>
                    <h3><a href="category.php">Category</a></h3>
                    <h3><a href="user.php">Users</a></h3>
                    <button type="button"><a href="add-post.php">Add New Post</a></button> 

                <?php } ?>  
   </div>
   <?php
    include_once 'config.php';
    $uid = $_GET['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $name = $fname." ".$lname;
    $username = $_POST['username'];
    $email = $_POST['email'];
    //$password = $_POST['password'];
    $role = $_POST['role'];
    if(isset($_POST['update'])){
        $sql1 = "UPDATE user SET name = $name , username = $username, email = $email, role = $role WHERE uid = $uid";
        $result1 = mysqli_query($conn,$sql1) or die("Query failed");

    }
   ?>
   <div class="add-user">
       <?php
        
        $sql = "SELECT * FROM user WHERE uid=$uid";
        $result =mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $fname = reset(explode(" ",$row['name']));
        $lname = end(explode(" ",$row['name']));
        

       ?>
       <h2>Add New user</h2>
       <div class="add-user-content">
           
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <label>First Name:</label><br>
                <input type="text" name="fname" value="<?php echo $fname ?>"><br>
                <label>Last Name:</label><br>
                <input type="text" name="lname" value="<?php echo $lname  ?>"><br>
                <label>Username:</label><br>
                <input type="text" name="username" value="<?php echo $row['username'] ?>"><br>
                <label>Email:</label><br>
                <input type="email" name="email" value="<?php echo $row['email'] ?>"><br>
                <!--<label>Password:</label><br>
                <input type="password" name="password" placeholder="Password"><br>-->
                <label>Role:</label><br>
                <select name="role">
                    <option value="" disabled>Select User Role</option>
                    <?php
                    if($row['role'] == 'admin'){
                    ?>
                    <option value="<?php $row['role'] ?>" selected>Admin</option>
                    <?php }else{ ?>
                    <option value="<?php $row['role'] ?>"  selected>Normal-user</option>
                    <?php } ?>
                </select>
                <input type="submit" name="update" value="update user">
            </form>
        </div>    
   </div>
   <div class="footer">
       <div class="footer-content">
           <h3>Category</h3><hr>
           <ul>
               <li>Politics</li>
               <li>Sports</li>
               <li>Health</li>
               <li>Technoogy</li>
               <li>Business</li>
           </ul>
       </div>
       <div class="footer-content">
           <h3>Contact Us</h3><hr>
           <ul>
               <li>Email: ghulamrabbani993@gmail.com</li>
               <li>Phone: 8349256007</li>
               <li>Adress1: ....</li>
               <li>Adress2: ....</li>
               <li>Adress3: ....</li>
           </ul>
       </div>
       <div class="footer-content">
           <h3>Social Conatct</h3><hr>
           <ul>
               <li><i class="fab fa-facebook-square"></i>Facebook</li>
               <li><i class="fab fa-twitter-square"></i>Twitter</li>
               <li><i class="fab fa-instagram"></i>Instagram</li>
               <li><i class="fab fa-pinterest"></i>Pinterest</li>
               <li><i class="fab fa-linkedin"></i>Linkedin</li>
           </ul>
       </div>
   </div>
</body>
</html>