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
    <title>Gallery</title>
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

            }
            ?>
            <a href="home.php"> <button class="btn">Home</button> </a>
            <a href="profile.php"> <button class="btn">Profile</button> </a>
            <a href="contact.php"> <button class="btn">Contact</button> </a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <h1>Welcome to Gallery <b><?php echo $res_username ?></b>!!!!</h1>
            </div>
          </div>
          <div class="bottom">
          <div class="gallery">
        <img src="images/image1.jpg" alt="Image 1">
        <div class="box">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus explicabo cupiditate at quo tempore est! Quos quasi quis molestias accusantium vero dolorem amet, quia, commodi perferendis iste nostrum. Expedita, molestiae!</p>
        </div>
        <img src="images/image2.jpg" alt="Image 2">
        <div class="box">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus explicabo cupiditate at quo tempore est! Quos quasi quis molestias accusantium vero dolorem amet, quia, commodi perferendis iste nostrum. Expedita, molestiae!</p>
        </div>
        <img src="images/image3.jpg" alt="Image 3">
        <div class="box">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus explicabo cupiditate at quo tempore est! Quos quasi quis molestias accusantium vero dolorem amet, quia, commodi perferendis iste nostrum. Expedita, molestiae!</p>
        </div>
    </div>
          </div>
       </div>

    </main>
</body>
</html>