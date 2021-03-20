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
    <div class="admin-pages">
    <?php
                
                if(isset($_SESSION['username']) && isset($_SESSION['password'])){
                ?>
                    <h3><a href="post.php">Post</a></h3>
                    <h3><a href="category.php">Category</a></h3>
                    <h3><a href="user.php">Users</a></h3>
                    
                    <h3><a href='logout.php'>Logout</a></h3>
                <?php    
                }else{
                ?>
                    <h3><a href="post.php">Post</a></h3>
                    <h3><a href="category.php">Category</a></h3>
                    <h3><a href="user.php">Users</a></h3>
                    

                <?php } ?>  

    </div>
    <div class="add-post">
        <h2>Add New post</h2>
        <div class="add-post-content">
            <?php
            $pid = $_GET['id'];
            $sql = "SELECT * FROM post WHERE pid = $pid";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
            }
            $cid = $row['category'];
             
            
           ?>

            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <label>Title:</label><br>
                <input type="text" name="title" value="<?php echo $row['post_title'] ; ?>"><br>
                <label>Description:</label><br>
                <textarea name="description" value="<?php echo $row['post_desc'] ; ?>"><?php echo $row['post_desc'] ; ?></textarea><br>
                <label>Image:</label><br>
                <input type="file" name="image" value="<?php echo $row['post_image'] ; ?>"><br>
                <label>Category:</label><br>
                <select name="category">
                    <option value="" disabled>Select category</option>
                    <?php
                       $sql1 = "SELECT category_name FROM category WHERE cid = $cid";
                        $result1 = mysqli_query($conn, $sql1);
                        if(mysqli_num_rows($result1) > 0){
                            while($row1 = mysqli_fetch_assoc($result1)){
                               echo "<option value=".$row1['cid'].">".$row1['category_name']."</option>"; 
                            }
                        }
                    ?>
                    <option value=""></option>
                </select>
                <input type="submit" name="update" value="Update post">
            </form>
        </div>
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