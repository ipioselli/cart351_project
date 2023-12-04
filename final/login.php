<?php
session_start();

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

    // Check if the user exists in a text file (users.txt)
    $usersFile = 'user.txt';
    $userFound = false;

    if (file_exists($usersFile)) {
        $users = file($usersFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($users as $user) {
            list($existingUsername, $existingPassword) = explode(':', $user);
            if ($existingUsername === $username && $existingPassword === $password) {
                $userFound = true;
                break;
            }
        }
    }

    if ($userFound) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
         header('Location: login.php?error:wronguserandpassword');
    }
} 


?>



    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/user.css">
    </head>
    <body>
      

    

    <div class="main-register">
    <h3 class="login"><a href="register.php">Create Account</a></h3>
        <h2>Go Green</h2>

        <div class="register">
        <h3>Login</h3>
        <form action="" method="post">
            <fieldset>
            <p class="username"><label for="username">Username:</label></p>
            <input type="text" id="username" name="username" required><br>
            <p class="password"><label for="password">Password:</label></p>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" id="submit-register" name="login" value="Login">
            </fieldset>
        </form>


        </div>

    
    </div>

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

