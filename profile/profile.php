<?php
session_start();

include("php/config.php");

// Save the current page URL in a session variable
$_SESSION['last_visited'] = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
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
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_username = $result['Username'];
                $res_Email = $result['Email'];
                $res_id = $result['Id'];
                $res_age = $result['Age'];
                $res_gender = $result['Gender'];
                $res_cnum = $result['Mobile_number'];
                $res_hobbies = $result['Hobbies'];
                $res_firstname = $result['Firstname'];
                $res_lastname = $result['Lastname'];
                $res_mobile_number = $result['Mobile_number'];

            }
            ?>
            <a href="home.php"> <button class="btn">Home</button> </a>
            <a href="gallery.php"> <button class="btn">Gallery</button> </a>
            <a href="contact.php"> <button class="btn">Contact</button> </a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <h1>Welcome to your Profile <b><?php echo $res_username ?></b>!!!!</h1>
            </div>
            <div class="box">
                <p>Your email is <b><?php echo $res_Email ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p><strong>Username: </strong><?php echo $res_username ?></p>
                <p><strong>First Name: </strong><?php echo $res_firstname ?></p>
                <p><strong>Last Name: </strong><?php echo $res_lastname ?></p>
                <p><strong>Age: </strong><?php echo $res_age ?></p>
                <p><strong>Gender: </strong><?php echo $res_gender ?></p>
                <p><strong>Mobile Number: </strong><?php echo $res_cnum ?></p>
                <p><strong>Hobbies: </strong><?php echo $res_hobbies ?></p>



            </div>
          </div>
       </div>

    </main>
</body>
</html>