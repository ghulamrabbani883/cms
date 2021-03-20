<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEws site</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="nav">
        <div class="logo">
            <img src="images/concept-fake-news.jpg" alt="LOGO" width="200px" height="50px">
        </div>
        <ul class="menu">
            <li><a href="admin/post.php" target="_blank">Post</a></li>
            <li><a href="#">Politics</a></li>
            <li><a href="#">Sports</a></li>
            <li><a href="#">Health</a></li>
            <li><a href="#">Technology</a></li>
            <li><a href="#">Business</a></li>

        </ul>
    </div>

    <div class="full-content">
        <div class="news-content" id="news-content-grow">
            <?php
include_once 'admin/config.php';
$pid = $_GET['id'];
$sql = "SELECT * FROM post WHERE pid=$pid";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    $row =mysqli_fetch_assoc($result);

    $uid = $row['author'];
        $cid = $row['category'];
        $sql1 = ("SELECT name FROM user WHERE uid = $uid");
        $sql2 = ("SELECT category_name FROM category WHERE cid = $cid ");
            
        $result1 = mysqli_query($conn,$sql1); 
        $result2 = mysqli_query($conn,$sql2);
        
        if(mysqli_num_rows($result2) > 0){
            $row2 = mysqli_fetch_assoc($result2);
        }
?>
            <div class="full-news-content">
                <h2><?php echo $row['post_title']; ?></h2>

                <img src="admin/upload/<?php echo $row['post_image']; ?>" alt="news 1" class="center" height="300px"
                    width="600px">
                <figcaption>
                    <span style="color:blue; margin:10px; text-align:center;"><?php echo $row['author'];?></span>
                    <span style="color:blue; margin:10px; text-align:center;"><?php echo $row['post_date'];  ?></span>
                    <span style="color:blue; margin:10px; text-align:center;"><?php echo $row2['category_name'] ; ?></span>
                </figcaption>
                <p><?php echo $row['post_desc']; ?></p>

            </div>
            <?php
}
?>
        </div>
        <div class="news-content" id="side-bar-grow">

            <div class="search">
                <h3>SEARCH</h3>
                <input type="text" name="search-text" value="" placeholder="search">
                <input type="submit" name="search">
            </div>
            <div class="latest-news">
                <h2>Latest News</h2>
                <div class="side-bar-news">
                    <h3>News 1</h3>
                    <img src="images/nature_flower_sky_218344.jpg" alt="news 1" height="100px" width="200px">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Unde officiis doloribus quia dolorem,
                        odit nemo enim delectus eveniet perferendis et, harum a inventore repellat eligendi maiores
                        reiciendis! Assumenda, accusantium ea.</p>
                    <a href="#">Read More</a>

                </div>
            </div>
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

    <div class="copyright">@All rights reserved | ghulamrabbani883@gmail.com</div>
</body>

</html>