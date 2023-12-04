


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Green</title>
    <link rel="stylesheet" href="css/style.css">
</head>
    
    
  
<body>
 
<!-- main div -->
<div class="main">

    <!-- nav bar section -->
    <div class="topnav">
        <h2><a href="index.php">Home</a></h2>
        <h2><a href="">Feed</a></h2>
        <h2><a href="">Quiz</a></h2>
        <h2><a style="float:right; border:solid; border-radius: 25px; padding:10px; " href="login.php">Login</a></h2>
    </div>
   
    <!-- user section -->
    <div class="welcome-back">
        <h2 class="username" id="username"></h2>
        <h1>Welcome back!</h1>
        <p>Help offset your carbon footprint and go to your feed</p>
        <h3><a href="feed.php">Go to Feed</a></h3>
    </div>

    <!-- about the website section -->
    <div class="about">
    <h1>Climate Changes</h1>
        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        <h3><a href="">More Info</a></h3>

    </div>



</div>



<section class="bout">
    <h2>About us</h2>
    <div class="main">

        <div class="main-each">
           <h1>Quiz</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. At suscipit ex vel molestiae temporibus voluptatum laudantium exercitationem assumenda! Eligendi pariatur voluptate sapiente quaerat quia eum nulla voluptates alias suscipit ex.</p>

        </div>
        <div class="main-each">
            <h1>Calendar</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt, reiciendis corporis error sapiente dolorem obcaecati facere perferendis sint reprehenderit! Quis omnis animi nesciunt in nihil quam perspiciatis beatae pariatur minus?</p>

        </div>

    </div>
</section>





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
    




    <script>

        document.addEventListener('DOMContentLoaded', function() {
        let usernameElement = document.getElementById('username');
        let username = "<?php session_start(); echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>";

        if (username !== '') {
            usernameElement.textContent = "Hello, " + username + "!";
            usernameElement.style.fontSize = '3em'; // Change font size dynamically
            usernameElement.style.color = 'white'; // Change color dynamically
            usernameElement.style.padding = '20px';
            // Add other CSS properties as needed
        } else {
            usernameElement.textContent = "Please log in!";
        }
    });
           

        

    
   
  </script>
</body>
</html>
