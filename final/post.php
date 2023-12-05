<?php
 session_start();

 if (isset($_GET['action']) && $_GET['action'] === 'get_username') {
   if (isset($_SESSION['username'])) {
     echo $_SESSION['username'];
   }
 
   exit; 
 }

 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
 // need to process
 
 
 $task = $_POST['user_task'];
 $date = $_POST['user_date'];
 $username = $_SESSION['username'];
  
 
 
 // check that there is a FILES ARRAY

    $filePath = 'posts.txt';
    $theFile = fopen($filePath, "a") or die("Unable to open file");
     //writing to the file
    
 
         fwrite($theFile, "\n"."DATE:".$date."\n");
         fwrite($theFile, "TASK:".$task."\n");
         fwrite($theFile, "USER:".$username."\n");
         fclose($theFile);
 
 
         //reading from the file
         $theFileToRead = fopen('posts.txt', "r") or die("Unable to open file!");
    //read until eof
    //$i=0;

    $outArr = array();
    $NUM_PROPS = 3;
     //echo("test");
       while(!feof($theFileToRead)) {
         //create an object to send back
 
         $packObj=new stdClass();
 
         for($j=0;$j<$NUM_PROPS;$j++){
           $str = fgets($theFileToRead);
           //split and return an array ...
           $splitArr = explode(":",$str);
           $key = $splitArr[0];
           $val = $splitArr[1];
           //append the key value pair
           $packObj->$key = trim($val);
         }
         $outArr[]=$packObj;
       }
 
       fclose($theFileToRead);
         // var_dump($outArr);
         // Now we want to JSON encode these values to send back.
        $myJSONObj = json_encode($outArr);
       echo $myJSONObj;
       exit;
     
     
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/feed.css">
</head>
<body>

<div class="main">

    <!-- nav bar section -->
    <div class="topnav">
        <h2><a href="index.php">Home</a></h2>
        <h2><a href="post.php">Feed</a></h2>
        <h2><a href="">Quiz</a></h2>
        <h2><a style="float:right; border:solid; border-radius: 25px; padding:10px; " href="login.php">Login</a></h2>
    </div>

    <div class="user-info">
        <h2 id="usernameDisplay" class="display username"></h2>
        <h1>Welcome back!</h1>
        <h2 id="pointsDisplay" class = "display-points"></h2>
        
    </div>

    <div class="tips">
        <h2>Tip: </h2>
    </div>


    <div class="form">
        <form id="get_Form">
            <h2>Daily Eco Tasks</h2>
            <fieldset>
                <p><label>Day:</label></p>
                <p class="date"><label></label><input type="date" name="user_date" id="date" required></p>
                <p ><label>Write down the task you completed:</label></p>
                <p class="task"><label></label><textarea name="user_task" id="task" cols="30" rows="10" type="text" required></textarea></p>
                <p class="show"><input type="submit" name="submit" value="Submit" id="submit_btn"></p>
              
            </fieldset>



        </form>
    </div>

    <div id="result">
        <h2>Eco Feed</h2>
         <div class="post_results"></div>

    </div>


</div>








<script>

    window.onload= function(){
       
       
        function fetchUsername() {
        fetch('post.php?action=get_username')
        .then(response => response.text())
        .then(data => {
         let usernameDisplay = document.getElementById('usernameDisplay');
          usernameDisplay.textContent = "Hello " + data + " !";
          
          // Change CSS properties
          usernameDisplay.style.fontSize = '3em';
          usernameDisplay.style.color = 'white';
          usernameDisplay.style.padding = '10px';
          // Add other CSS properties as needed
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }

    fetchUsername();


    document.querySelector("#get_Form").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            let form = document.querySelector("#get_Form");
            let data = new FormData(form);

            fetch('post.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(result => {
                showResults(result);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

    function showResults(arrayFromServer){
            document.querySelector(".post_results").innerHTML="";
            for(let i=0; i<arrayFromServer.length; i++){

                //date
                let container = document.createElement("div");
                container.classList.add("result_container");
                let date = document.createElement("h1");
                date.innerHTML = "Date:"+arrayFromServer[i].DATE;
                container.appendChild(date);


                //task
                let task = document.createElement("h1");
                task.innerHTML = arrayFromServer[i].TASK;
                container.appendChild(task);
                document.querySelector(".show").appendChild(container);
            }

         }


    }
    
  </script>
    
</body>
</html>