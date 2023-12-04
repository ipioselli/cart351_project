<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username is not empty
    if (empty($username)) {
        echo "Username cannot be empty!";
        exit;
    }

    // Check if the password is not empty
    if (empty($password)) {
        echo "Password cannot be empty!";
        exit;
    }

    // Check if the user already exists in a text file (users.txt)
    $usersFile = 'user.txt';

    if (file_exists($usersFile)) {
        $users = file($usersFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($users as $user) {
            list($existingUsername, $_) = explode(':', $user);
            if ($existingUsername === $username) {
            
                echo "User already exists!";
                // echo "Go to Login page";
                // header('Location: register.php?error=useralreadyexists');

                exit;
            }
        }
    }

    // Append the new user to the text file
    $newUser = "$username:$password" . PHP_EOL;
    file_put_contents($usersFile, $newUser, FILE_APPEND | LOCK_EX);


    header('Location: login.php');

} 
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" type="text/css" href="css/user.css">
</head>
<body>


   

<div class="main-register">
    <h3 class="login"><a href="login.php">Login</a></h3>
    <h2>Go Green</h2>

<div class="register">
<h3>Create an Account</h3>
<form action="register.php" method="post">
<fieldset>
<p class="username"><label for="username">Username:</label></p>
<input type="text" id="username" name="username" required><br>
<p class="password"><label for="password">Password:</label></p>
<input type="password" id="password" name="password" required><br><br>
<input type="submit" id="submit-register" value="Register">
</fieldset>
</form>

</div>
    </div>
    
    <!-- footer -->
    <div class="footer">
        <h2>Contact Us</h2>

        <div class="contact">
        
            <div class="contact-us">
                <p>Ines Pioselli</p>
            </div>
            
            <div class="contact-us">
                <p>Huyen Tran </p>
            </div>

        </div>
    </div>


    <div class="second-footer">
        <h2>&#169;Cart 351 Final Project</h2>
    </div>
    
   

</body>
</html>
