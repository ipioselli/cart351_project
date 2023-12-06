<?php
 session_start();

 //deals with the username 
 if (isset($_GET['action']) && $_GET['action'] === 'get_username') {
   if (isset($_SESSION['username'])) {
     echo $_SESSION['username'];
   }
 
   exit; 
 }



 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {

 $task = $_POST['user_task'];
 $date = $_POST['user_date'];
 $username = $_SESSION['username'];
  
 
 
 // check that there is a FILES ARRAY

    $filePath = 'posts.txt';
    $theFile = fopen($filePath, "a") or die("Unable to open file");
     //writing to the file
    
 
         fwrite($theFile, "\n"."DATE:".$date."\n");
         fwrite($theFile, "TASK:".$task."\n");
         fwrite($theFile, "USER:".$username);
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
        <h1>Welcome to your eco gallery!</h1>
        <h2 class="points" id="points"></h2>
        

        
    </div>

    <div class="tips">
        <h2>How it works: </h2>
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
    
        
         <div class="post_results"> 
            <h2>Eco Feed</h2>
        
        
        </div>
        

    </div>


</div>








<script>

    window.onload= function(){
        
        fetchUsername();
        
     
        
        //username
        function fetchUsername() {
        fetch('post.php?action=get_username')
        .then(response => response.text())
        .then(data => {
         let usernameDisplay = document.getElementById('usernameDisplay');
          usernameDisplay.textContent = "idk " + data + " !";
          
          // CSS properties
          usernameDisplay.style.fontSize = '3em';
          usernameDisplay.style.color = 'white';
          usernameDisplay.style.padding = '10px';
        
          //get points
          fetchPoints();
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
    
    function fetchPoints(userLoggedIn) {
        console.log("hello points");
        fetch('post.php')
        .then(response => response.json())
        .then(data => { showPoints(data,userLoggedIn);
        })
        }
       
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
         

          fetchPoints(data);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
    

   
    
   

    



    document.querySelector("#get_Form").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            let form = document.querySelector("#get_Form");
            let data = new FormData(form);

            fetch('post.php', {
                method: 'POST',
                body: data
            })
            
            .then(function(response){
                return response.json();

            })
            // response => response.json())
            .then(result => {
                showResults(result);
                console.log(result);
             
            })
            .catch(error => {
                // console.error('Error:', error);
            });
        });

    function showResults(arrayFromServer){
        document.querySelector(".post_results").innerHTML="";
        let pointsArray = [];
           
            for(let i=0; i<arrayFromServer.length; i++){

                let user = arrayFromServer[i].USER;
                let found =false;
                for(let j = 0; j<pointsArray.length; j++){
                    let  pointsObj = pointsArray[j];
                    if(pointsObj.name ===user && found ===false){
                        console.log("here");
                        pointsObj.points++;
                        found =true;

                        
                    }
                    
                }

                if(found ===false){
                    pointsArray.push({name:user, points:1});
                }

                for(let j = 0; j<pointsArray.length; j++){
                    let  pointsObj = pointsArray[j];
                    if(pointsObj.name ===user){
                        console.log(pointsObj);
                        let points1 = document.getElementById("points");
                        points1.textContent = "Points:" + pointsObj.points; 
                        
                break;
                        

                        
                    }
                    
                }

               
                let container = document.createElement("div");
                container.classList.add("result_container");

                //username
                let username1 = document.createElement("h2");
                username1.innerHTML = arrayFromServer[i].USER;
                container.appendChild(username1);

                

                //date
                
                
                let date = document.createElement("h1");
                date.innerHTML = "Date:"+arrayFromServer[i].DATE;
                container.appendChild(date);


                //task
                let task = document.createElement("h1");
                task.innerHTML = arrayFromServer[i].TASK;
                container.appendChild(task);
                document.querySelector(".post_results").appendChild(container);
            }

         }



         function showPoints(arrayFromServer,userLoggedIn){
        let pointsArray = [];
            
            for(let i=0; i<arrayFromServer.length; i++){

                let user = arrayFromServer[i].USER;
                let found =false;
                for(let j = 0; j<pointsArray.length; j++){
                    let  pointsObj = pointsArray[j];
                    if(pointsObj.name ===user && found ===false){
                        console.log("here");
                        pointsObj.points++;
                        found =true;

                        
                    }
                    
                }
                if(found ===false){
                    pointsArray.push({name:user, points:1});
                }

                for(let j = 0; j<pointsArray.length; j++){
                    let  pointsObj = pointsArray[j];
                    if(pointsObj.name ===userLoggedIn){
                        console.log(pointsObj);
                        let points1 = document.getElementById("points");
                     points1.textContent = "Points:" + pointsObj.points; 
                break;
                        

                        
                    }
                    
                }

               
               
            
            }

         }


        
   


    }
    
  </script>
    
</body>
</html>