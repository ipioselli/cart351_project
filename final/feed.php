<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['username'])) {
    $post_content = $_POST['post_content'];

    // Save the post to a file or database (e.g., posts.txt)
    // $postsFile = 'feedInput.txt';
    $post = $_SESSION['username'] . ': ' . $post_content . PHP_EOL;
    file_put_contents($postsFile, $post, FILE_APPEND | LOCK_EX);
    
    $description = $_POST['user_description'];
    $date = $_POST['user_date'];

    // Assign a point to the user for posting
    $pointsFile = 'points.txt';
    $userPoints = [];
    if($_FILES)
    {

    }
    if (file_exists($pointsFile)) {
        $userPoints = json_decode(file_get_contents($pointsFile), true);
    }

    $username = $_SESSION['username'];
    if (!isset($userPoints[$username])) {
        $userPoints[$username] = 0;
    }

    $userPoints[$username]++;
    file_put_contents($pointsFile, json_encode($userPoints), LOCK_EX);
    

    header('Location: feed.php');
    exit;
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2 class="username" id="username"></h2>
<div class="idk">
    <h2>hey</h2>

</div>

<div class="help">
<h2>User Post System</h2>
  <form action="feed.php" method="post" id="postForm">
    <textarea id="post_content" name="post_content" required></textarea><br>
    <input type="submit" value="Post">
  </form>

</div>



<!-- footer -->

<!-- <div class="footer">
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
    </div> -->



<script>


</script>
   





 
</body>
</html>

