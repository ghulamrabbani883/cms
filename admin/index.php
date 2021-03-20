<?php
include_once 'config.php';
session_start();
if(isset($_SESSION['username'])){
    header("Location:post.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    input[type="text"],
    input[type="password"] {
        width: 300px;
        padding: 5px;
        border: 1px solid #291606;
    }

    input[type="submit"] {
        border: 1px solid #291606;
        padding: 5px;
        background-color: blue;
        color: #fff;
        margin-top: 10px;
        width: 100px;
    }
    </style>
</head>

<body>

    <div class="admin" style="background-color: hsl(220, 7%, 92%); padding:200px 400px;">
        <h1>Admin</h1>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
            <label>Username:</label><br>
            <input type="text" name="username" required><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br>
            <input type="submit" name="login" value="Login">
        </form>
        <?php 

    if(isset($_POST['login'])){
        include_once 'config.php';
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn,$sql) or die("Query failed");

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['password']  = $row['password'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['user_id'] = $row['id'];

                header("Location:post.php");
            }
        }else{
            echo "<div>Username and password are incorrects</div>";
        }
    }
    ?>
    </div>
</body>

</html>