<?php
  // PHP code to handle the request for the username, form submission, and getting user posts
  session_start();

  if (isset($_GET['action']) && $_GET['action'] === 'get_username') {
    if (isset($_SESSION['username'])) {
      echo $_SESSION['username'];
    } else {
      echo "No username found";
    }
    exit; // Stop further PHP execution after sending the response
  }

  if (isset($_POST['action']) && $_POST['action'] === 'submit_post' && isset($_SESSION['username'])) {
    // PHP code for submitting posts (same as before)
    // ...
    $postsFile = 'feedInput.txt';
    $username = $_SESSION['username'];
    $postContent = $_POST['post_content'];
    $postDate = $_POST['post_date'];

    // Save post to user_posts.txt
    $post = "$username : $postContent : $postDate" . PHP_EOL;
    file_put_contents($postsFile, $post, FILE_APPEND | LOCK_EX);

    // Increment user's points
    $pointsFile = 'points.txt';
    $userPoints = [];
    if (file_exists($pointsFile)) {
      $userPoints = json_decode(file_get_contents($pointsFile), true);
    }

    if (!isset($userPoints[$username])) {
      $userPoints[$username] = 0;
    }

    $userPoints[$username]++;
    file_put_contents($pointsFile, json_encode($userPoints), LOCK_EX);


    exit; // Stop further PHP execution after handling the submission
  }

  if (isset($_GET['action']) && $_GET['action'] === 'get_user_posts' && isset($_SESSION['username'])) {
    $postsFile = 'feedInput.txt';
    $userPosts = file_exists($postsFile) ? file($postsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

    foreach ($userPosts as $post) {
      echo "<p>$post</p>";
    }
    exit; // Stop further PHP execution after sending the user posts
  }
  ?>


<!DOCTYPE html>
<html>
<head>
  <title>User Post System</title>
</head>
<body>
  <h2>User Post System</h2>

  <!-- Display username -->
  <p id="usernameDisplay"></p>

  <!-- Form to submit text and date -->
  <form id="postForm">
    <textarea id="post_content" name="post_content" placeholder="Enter text" required></textarea><br>
    <input type="date" id="post_date" name="post_date" required><br>
    <input type="submit" value="Post">
  </form>

  <!-- Button to display posts -->
  <button id="displayPostsBtn">Display Posts</button>

  <!-- Display user posts -->
  <div id="userPosts"></div>

  <!-- JavaScript -->
  <script>

    window.onload = function(){
        function fetchUsername() {
      fetch('test.php?action=get_username')
        .then(response => response.text())
        .then(data => {
          const usernameDisplay = document.getElementById('usernameDisplay');
          usernameDisplay.textContent = data;
          
          // Change CSS properties
          usernameDisplay.style.fontSize = '24px';
          usernameDisplay.style.color = 'green';
          // Add other CSS properties as needed
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }

    fetchUsername();

    // Handle form submission
    document.getElementById('postForm').addEventListener('submit', function(event) {
      event.preventDefault();
      const formData = new FormData(this);
      formData.append('action', 'submit_post'); // Add action for PHP handling
      
      fetch('test.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok) {
          fetchUsername(); // Refresh username display after posting
        }
      });
    });

    // Handle button click to display user posts
    document.getElementById('displayPostsBtn').addEventListener('click', function() {
      fetch('test.php?action=get_user_posts')
        .then(response => response.text())
        .then(data => {
          document.getElementById('userPosts').innerHTML = data;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });
        
    }
    
  </script>

  
</body>
</html>
