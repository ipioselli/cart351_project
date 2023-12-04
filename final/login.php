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
        echo "Invalid username or password!";
        exit;
    }
} 


?>



    <!DOCTYPE html>
    <html>
    <head>
        <title>Login Page</title>
    </head>
    <body>
        <h2>Login</h2>
        <form action="" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" name="login" value="Login">
        </form>
    </body>
    </html>
    <?php

?>
