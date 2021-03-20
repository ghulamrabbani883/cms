<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEws site</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
  
   <div class="content">
   <?php
        include_once 'admin/config.php';
        if(isset($_GET['search'])){
            $search_term = $_GET['search_text'];

            $sql = "SELECT post.post_title, post.post_desc,post.post_date, post.post_image, post.author FROM post  WHERE post.post_title LIKE '%$search_term' OR post.post_desc LIKE '%$search_term'";
            $result = mysqli_query($conn,$sql) or die("Query Failed"); ?>
            
        <div class="news-content" id="news-content-grow">
        <h1>Search: <?php  echo $search_term ; ?></h1>
        <?php
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){ ?>
            <div class="main-content-news">
                
                <h3><?php echo $row['post_title']; ?></h3>
                
                <span style="color:blue; margin:10px;"><?php echo $row['author'];  ?></span>
                <span style="color:blue; margin:10px;"><?php echo $row['post_date'];  ?></span>
                <span style="color:blue; margin:10px;"></span>
                <img src="admin/upload/<?php echo $row['post_image']; ?>" alt="news 1" height="150px" width="300px">
                <p><?php echo substr($row['post_desc'],0,250); ?>....</p>
                <a href="single.php?id=<?php echo $row['pid']; ?>">Read More--></a>
                
            </div>
            <?php 
     
   
                }
            }
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
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Unde officiis doloribus quia dolorem, odit nemo enim delectus eveniet perferendis et, harum a inventore repellat eligendi maiores reiciendis! Assumenda, accusantium ea.</p>
                    <a href="#">Read More</a>
                    
                </div>
            </div>
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

   <div class="copyright">@All rights reserved | ghulamrabbani883@gmail.com</div>
</body>
</html>