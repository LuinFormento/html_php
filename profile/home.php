<?php 
session_start();

include("php/config.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Home</a> </p>
        </div>

        <div class="right-links">

            <?php 
            if(isset($_SESSION['valid'])){
                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_id = $result['Id'];
                }
                ?>
                <a href="profile.php"> <button class="btn">Profile</button> </a>
                <a href="gallery.php"> <button class="btn">Gallery</button> </a>
                <a href="contact.php"> <button class="btn">Contact</button> </a>
                <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
                <?php
            } else {
                // If not logged in, show login and registration links
                ?>
                <a href="index.php"> <button class="btn">Login</button> </a>
                <a href="register.php"> <button class="btn">Register</button> </a>
                <?php
            }
            ?>

        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <?php 
                if(isset($_SESSION['valid'])){
                    echo "<h1>Welcome <b>$res_Uname</b>!!!!</h1>";
                } else {
                    echo "<h1>Welcome to Home Page!</h1>";
                }
                ?>
            </div>
            <?php 
            if(isset($_SESSION['valid'])){
                // If logged in, show email information
                ?>
                <div class="box">
                    <p>Your email is <b><?php echo $res_Email ?></b>.</p>
                </div>
                <?php
            }
            ?>
          </div>
       </div>

    </main>
</body>
</html>
