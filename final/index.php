<?php
 session_start();

 if (isset($_GET['action']) && $_GET['action'] === 'get_username') {
   if (isset($_SESSION['username'])) {
     echo $_SESSION['username'];
   }
 
   exit; 
 }

?>

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

    <h2 class="green">Go Green</h2>
   
    <!-- user section -->
    <div class="welcome-back">
        <h2 class="username" id="username"></h2>
        <h1>Welcome back!</h1>
        <p>Help offset your carbon footprint and go to your feed</p>
        <h3><a href="post.php">Go to Feed</a></h3>
    </div>

    <!-- about the website section -->
    <div class="about">
    <h2>About Go Green</h2>
        <p>Help offset your indvidual carbon footprint by doing simple tasks to help the environment

        Carbon footprint is caused by human activities such as consuming electricity and driving a vehicle.
        The overall effect of our actions have severe consequences on the planet so we must help by doing the smallest things we can.
        This website allows you to track your daily tasks to offset your carbon footprint and maintain a longlasting streak. Learn more by clicking on
        link below.
        </p>
       
        <h3><a href="">More Info</a></h3>

    </div>



</div>

<!-- idk if i want this page yet -->
<!-- 
<div class="features">
    <h2>Features</h2>
    <div class="features-main">

        <div class="feachers-each">
            <h2>Calender</h2>

        </div>
        <div class="feachers-each">
            <h2>Interactive Map</h2>
            
        </div>

    </div>

</div> -->





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

        window.onload = function(){
        getUsername();

        function getUsername(){
        fetch('index.php?action=get_username')
        .then(response => response.text())
        .then(data => {
         let usernameDisplay = document.getElementById("username");
          usernameDisplay.textContent = "Hello " + data + " !";
          
         
          //css properties to display the username
          usernameDisplay.style.fontSize = '3em';
          usernameDisplay.style.color = 'white';
          usernameDisplay.style.padding = '20px';
         
          
        })
        .catch(error => {
          console.error('Error:', error);
        });

            }
        }

        
           

        

    
   
  </script>
</body>
</html>
