<?php
session_start();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Login logic
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Here, you should validate against your user storage method (in this case, a text file)
        $usersFile = 'user.txt';

        if (file_exists($usersFile)) {
            $users = file($usersFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($users as $user) {
                list($existingUsername, $hashedPassword) = explode(':', $user);
                if ($existingUsername === $username && password_verify($password, $hashedPassword)) {
                    $_SESSION['username'] = $username;
                    break;
                }
            }
        }

        if (isset($_SESSION['username'])) {
            header('Location: index.php');
            exit;
        } else {
            echo "Invalid username or password!";
        }
    } elseif (isset($_POST['logout'])) {
        // Logout logic
        session_unset();
        session_destroy();
        header('Location: index.html');
        exit;
    }
}

// if (isset($_SESSION['username'])) {
//     $username = $_SESSION['username'];

//     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quiz_submit'])) {
//         $score = 0;

//         foreach ($questions as $question => $answer) {
//             $userAnswer = $_POST[str_replace(' ', '_', $question)];
//             if ($userAnswer === $answer) {
//                 $score++;
//             }
//         }

//         echo "<h2>Quiz Results for $username</h2>";
//         echo "<p>Your score: $score / " . count($questions) . "</p>";
//         echo "<form action='' method='post'><input type='submit' name='logout' value='Logout'></form>";
//     } else {
//         echo "<h2>Welcome, $username!</h2>";
//         echo "<form action='' method='post'>";
//         foreach ($questions as $question => $answer) {
//             echo "<p>$question</p>";
//             echo "<input type='text' name='" . str_replace(' ', '_', $question) . "' required><br><br>";
//         }
//         echo "<input type='submit' name='quiz_submit' value='Submit'>";
//         echo "<input type='submit' name='logout' value='Logout'>";
//         echo "</form>";
//     }
// } 


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
