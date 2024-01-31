<?php
session_start();

include("php/config.php");

// Save the current page URL in a session variable
$_SESSION['last_visited'] = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}

// Handle form submission
if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];
    $message = mysqli_real_escape_string($con, $_POST['message']);

    // Insert the message into the messages table
    $insertQuery = mysqli_query($con, "INSERT INTO messages(user_message, iduser) VALUES('$message', $id)");

    if ($insertQuery) {
        echo "<div class='message'>
                  <p>Message submitted successfully!</p>
              </div> <br>";
    } else {
        echo "<div class='message'>
                  <p>Error occurred while submitting the message.</p>
              </div> <br>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Contact</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Home</a> </p>
        </div>

        <div class="right-links">

            <?php

            $id = $_SESSION['id'];
            $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

            while ($result = mysqli_fetch_assoc($query)) {
                $res_username = $result['Username'];
                $res_Email = $result['Email'];
                $res_id = $result['Id'];
            }

            ?>
            <a href="home.php"> <button class="btn">Home</button> </a>
            <a href="profile.php"> <button class="btn">Profile</button> </a>
            <a href="gallery.php"> <button class="btn">Gallery</button> </a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <h1>Welcome to Contact Page <b><?php echo $res_username ?></b>!!!!</h1>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
                    <div class="container">
                        <div class="box form-box">
                            <form action="" method="post">
                                <div class="field input">
                                    <label for="message">Message</label>
                                    <input type="text" name="message" id="message" autocomplete="off" required>
                                </div>
                                <div class="field">

                                    <input type="submit" class="btn" name="submit" value="Submit" required>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>
</html>
