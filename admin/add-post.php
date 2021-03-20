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
            include_once 'config.php';
            date_default_timezone_set('Asia/kolkata');
            $title =  $_POST['title'];
            $description =  $_POST['description'];
            $date = date('d-M-Y');
            
            $category = $_POST['category'];
            if(isset($_FILES['image'])){
                $error = array();

                $image_name = $_FILES['image']['name'];
                $image_size = $_FILES['image']['size'];
                $image_type = $_FILES['image']['type'];
                $image_tmp = $_FILES['image']['tmp_name'];
                $file_ext = end(explode('.',$image_name));

                $extensions = array("jpeg","jpg","png");

                if(in_array($file_ext,$extensions) === false){
                    $error[] = "This extension is not allowed, please choose jpeg, jpg, png only";
                }

                if($image_size > 2e+6){
                    $error[] = "File size is too large";
                }

                if(empty($error) == true){
                    move_uploaded_file($image_tmp,"upload/".$image_name);
                }else{
                    print_r($error);
                    die();
                }
                $sql2 = "SELECT name FROM user WHERE username = '{$_SESSION['username']}'";
                $result2 = mysqli_query($conn,$sql2);
                if(mysqli_num_rows($result2) > 0){
                $row2 = mysqli_fetch_assoc($result2);
                }
                $author = $row2['name'];


                $sql1 = "INSERT INTO post VALUES('','$title','$description','$date','$image_name','$category','$author');";
                $sql1 .= "UPDATE category SET post = post+1 WHERE cid = $category";
                
                $result1 = mysqli_multi_query($conn,$sql1);
                if($result1){
                    header("Location:post.php");
                }else{
                    echo "Query failed";
                }
            }
           ?>

            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <label>Title:</label><br>
                <input type="text" name="title" placeholder="Add title"><br>
                <label>Description:</label><br>
                <textarea name="description" placeholder="description"></textarea><br>
                <label>Image:</label><br>
                <input type="file" name="image"><br>
                <label>Category:</label><br>
                <select name="category">
                    <option value="" disabled>Select category</option>
                    <?php
                        $sql = "SELECT * FROM category";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                               echo "<option value=".$row['cid'].">".$row['category_name']."</option>"; 
                            }
                        }
                    ?>
                    <option value=""></option>
                </select>
                <input type="submit" name="submit" value="Add post">
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