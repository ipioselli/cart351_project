


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Climate Change</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
  
<body>
 
<div class="main">

  
    <div class="topnav">
        <h2><a href="index.html">Home</a></h2>
        <h2><a href="">Feed</a></h2>
        <h2><a href="">Quiz</a></h2>
        <h2><a style="float:right"href="login.php">Login</a></h2>
    </div>
   

    <div class="welcome-back">
        <h2 class="username" id="username"></h2>
        <h2>welcome back!</h2>
        <h3><a href="">Go to Feed</a></h3>
    </div>

    <div class="welcome-back">
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
            usernameElement.style.fontSize = '2em'; // Change font size dynamically
            usernameElement.style.color = 'green'; // Change color dynamically
            // Add other CSS properties as needed
        } else {
            usernameElement.textContent = "Please log in!";
        }
    });
           

        

    
   
  </script>
</body>
</html>
