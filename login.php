<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validate the username and password (This is just a simple example and not secure. Use proper authentication mechanisms in a real scenario)
        if ($username === 'user' && $password === 'password') {
            // Successful login - Redirect to a welcome page or do something else
            // header("Location: welcome.php");
            echo "success";
            exit();
        } else {
            echo "Invalid username or password. Please try again.";
        }
    }
}
?>