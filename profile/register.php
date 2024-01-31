<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 
        session_start();
        include("php/config.php");

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $hobbies = $_POST['hobbies'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $mobile_number = $_POST['mobile_number'];

            // Verify if the username or email is already in use
            $verify_username_query = mysqli_query($con, "SELECT Username FROM users WHERE Username='$username'");
            $verify_email_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

            if(mysqli_num_rows($verify_username_query) != 0 || mysqli_num_rows($verify_email_query) != 0) {
                echo "<div class='message'>
                          <p>Username or email is already in use. Please choose a different one.</p>
                      </div> <br>";
            } else {
                // Verify the unique email
                $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");

                if(mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                              <p>This email is used, Try another One Please!</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                } else {
                    // Password validation
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number    = preg_match('@[0-9]@', $password);
                    $symbol    = preg_match('@[^A-Za-z0-9]@', $password);

                    if(!$uppercase || !$lowercase || !$number || !$symbol || strlen($password) < 8) {
                        echo "<div class='message'>
                                  <p>Password must contain uppercase and lowercase letters, a symbol, a number, and be at least 8 characters long.</p>
                              </div> <br>";
                    } else if(substr($mobile_number, 0, 1) !== '0' || strlen($mobile_number) !== 11) {
                        echo "<div class='message'>
                                  <p>Mobile number should start with zero and have a length of 11 digits.</p>
                              </div> <br>";
                    } else {
                        // Insert data into the database
                        mysqli_query($con, "INSERT INTO users(Username, Email, Password, Confirm_Password, Age, Gender, Hobbies, Firstname, Lastname, Mobile_number) VALUES('$username', '$email', '$password', '$confirm_password', '$age', '$gender', '$hobbies', '$firstname', '$lastname', '$mobile_number' )") or die("Error Occurred");

                        echo "<div class='message'>
                                  <p>Registration successfully!</p>
                              </div> <br>";
                        echo "<a href='index.php'><button class='btn'>Login Now</button>";
                    }
                }
            }
        }
        ?>

            <header>Register</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="field input">
                    <label for="hobbies">Hobbies</label>
                    <input type="text" name="hobbies" id="hobbies" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="firstname">First Name</label>
                    <input type="firstname" name="firstname" id="firstname" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="lastname">Last Name</label>
                    <input type="lastname" name="lastname" id="lastname" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" name="mobile_number" id="mobile_number" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Log In</a>
                </div>
            </form>
        </div>
      </div>
</body>
</html>
