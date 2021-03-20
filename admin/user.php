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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

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
        <?php
                
                if(isset($_SESSION['username']) && isset($_SESSION['password'])){
                ?>
                    <h3><a href="post.php">Post</a></h3>
                    <h3><a href="category.php">Category</a></h3>
                    <h3><a href="user.php">Users</a></h3>
                    <button type="button"><a href="add-user.php">Add new User</a></button>
                    
                    <h3><a href='logout.php'>Logout</a></h3>
                <?php    
                }else{
                ?>
                    <h3><a href="post.php">Post</a></h3>
                    
                    <h3><a href="category.php">Category</a></h3>
                    <h3><a href="user.php">Users</a></h3>
                    <button type="button"><a href="add-user.php">Add new User</a></button>
                <?php }  ?>  
    </div>
    <div class="user">
        <?php
        include_once 'config.php';
        $sql = "SELECT * FROM user";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
              
        ?>
        <table>
            <tr>
                <th>S.No.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['uid']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td><a href="user-update.php?id=<?php echo $row['uid']; ?>"><i class="fa fa-edit"></i></a></td>
                <td><a href="user-delete.php?id=<?php echo $row['uid']; ?>"><i class="fa fa-trash"></i></a></td>
            </tr>
            <?php
             }
            }
            ?>
            
        </table>
    </div>
    <div class="footer">
        <div class="footer-content">
            <h3>Category</h3>
            <hr>
            <ul>
                <li>Politics</li>
                <li>Sports</li>
                <li>Health</li>
                <li>Technoogy</li>
                <li>Business</li>
            </ul>
        </div>
        <div class="footer-content">
            <h3>Contact Us</h3>
            <hr>
            <ul>
                <li>Email: ghulamrabbani993@gmail.com</li>
                <li>Phone: 8349256007</li>
                <li>Adress1: ....</li>
                <li>Adress2: ....</li>
                <li>Adress3: ....</li>
            </ul>
        </div>
        <div class="footer-content">
            <h3>Social Conatct</h3>
            <hr>
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