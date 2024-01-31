<?php 
session_start();

include("php/config.php");
if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Username='$username' AND Password='$password' ") or die("Select Error");
    $row = mysqli_fetch_assoc($result);

    if(is_array($row) && !empty($row)){
        $_SESSION['valid'] = $row['Email'];
        $_SESSION['username'] = $row['Username'];
        $_SESSION['id'] = $row['Id'];

        // Check if last_visited is set
        if (isset($_SESSION['last_visited'])) {
            // Redirect to the last visited page
            header("Location: " . $_SESSION['last_visited']);
        } else {
            // Redirect to home.php as default
            header("Location: home.php");
        }
    } else {
        echo "<div class='message'>
              <p>Wrong Email, Username, or Password</p>
              </div> <br>";
        echo "<a href='index.php'><button class='btn'>Go Back</button>";
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
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>

                <div class="links">
                    Don't have an account? <a href="register.php">Register Now</a>
                </div>
            </form>
        </div>
        <main>
            <div class="main-box top">
                <div class="top">
                    <div class="box">
                        <a href="home.php"> <button class="btn">Home</button> </a>
                    </div>
                </div>
                <div class="top">
                    <div class="box">
                        <p><h1>Welcome!!!</h1></p> 
                    </div>
                </div>
                <div class="bottom">
                    <div class="box">
                        <p>And you are always welcome to my website.</p> 
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
