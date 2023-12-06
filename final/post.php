<?php
 session_start();

 if (isset($_GET['action']) && $_GET['action'] === 'get_username') {
   if (isset($_SESSION['username'])) {
     echo $_SESSION['username'];
   }
 
   exit; 
 }

 if (isset($_GET['action']) && $_GET['action'] === 'displayResults') {
    
    
         //reading from the file
         $theFileToRead = fopen('files/posts.txt', "r") or die("Unable to open file!");
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

 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
 // need to process
 
 
 $task = $_POST['user_task'];
 $date = $_POST['user_date'];
 $username = $_SESSION['username'];
  
 
 
 // check that there is a FILES ARRAY

    $filePath = 'files/posts.txt';
    $theFile = fopen($filePath, "a") or die("Unable to open file");
     //writing to the file
    
 
         fwrite($theFile, "\n"."DATE:".$date."\n");
         fwrite($theFile, "TASK:".$task."\n");
         fwrite($theFile, "USER:".$username);
         fclose($theFile);
 
 
         
     
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
        <h1>Welcome to your eco gallery</h1>
        <h2 class="points" id="points"></h2>
       

        
    </div>

    <div class="tips">
        <h2>How it works:</h2>
        <p>Try to offset your individual carbon footprint by completing simple tasks that positively affect climate change</p>
        <p>Post a task each day and receive a point each time you posts</p>
        <h3>Example</h3>

        <form id="search_Form">
            <label for="number">Choose a number between 1-6: </label>
            <input type="text" id="number" required>
            <button class="tip_btn">Example</button>
            
        </form>
        <div class="example">
        <div id="tip-result" class = "tip_container"></div>

        </div>
        
    </div>


    <div class="form">
    <h2>Daily Eco Tasks</h2>
        <form id="get_Form">
            
            <fieldset>
                <p><label>Day:</label></p>
                <p class="date"><label></label><input type="date" name="user_date" id="date" required></p>
                <p ><label>Write down the task you completed:</label></p>
                <p class="task"><label></label><textarea name="user_task" id="task" cols="50" rows="10" type="text" required></textarea></p>
                <p class="show"><input type="submit" name="submit" value="Post" id="submit_btn"></p>
                
              
            </fieldset>
        </form>
    </div>

   
    <div id="result" class="show-results">
    <h2>Eco Feed</h2>
         <p class="show_results"><input type="submit" name="submit" value="Results" id="results_btn"></p>

        
         <div class="post_results">
            
         
         </div>

    </div>


</div>


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

    window.onload= function(){
        
        fetchUsername();
        
        document.getElementById("results_btn").addEventListener("click", fetchResults);

        document.getElementById("search_Form").addEventListener('submit', function(event){
            event.preventDefault();

            let numInput =document.getElementById('number').value;

            fetch('json/post.json')
            .then(response => response.json())
            .then(data =>{
                let numData = data.filter(entry => entry.number == numInput);
                displayTips(numData);
                console.log("yay");
            });
            console.log('help');
        })
       
        function displayTips(data){
            let tipDiv = document.getElementById('tip-result');
            tipDiv.innerHTML = '';

        data.forEach(entry => {
            let tipItem = document.createElement('div');
            tipItem.classList.add('examples');
            tipItem.innerHTML = `
                <p> Example: ${entry.tip} </p>
            `;
            tipDiv.appendChild(tipItem);
        });
        }

        function fetchResults() {
        console.log("hello");
        fetch('post.php?action=displayResults')
        .then(response => response.json())
        .then(data => { showResults(data);
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
         
          fetchPoints();
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
    
    function fetchPoints(userLoggedIn) {
        console.log("hello points");
        fetch('post.php?action=displayResults')
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
            .then(response => response.json())
            .then(result => {
                console.log(result);
             
            })
            .catch(error => {
                // console.error('Error:', error);
            });
        });

    function showResults(arrayFromServer){
        let pointsArray = [];
            document.querySelector(".post_results").innerHTML="";
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
                let username1 = document.createElement("h1");
                username1.innerHTML ="User: " +arrayFromServer[i].USER;
                container.appendChild(username1);
                username1.style.fontSize = "2em";
                username1.style.marginBottom ="5px";

                

                //date
                
                
                let date = document.createElement("p");
                date.innerHTML = "Date: "+arrayFromServer[i].DATE;
                container.appendChild(date);
                date.style.fontSize = "1em";
                date.style.marginBottom ="5px";


                //task
                let task = document.createElement("p");
                task.innerHTML = "Task: "+arrayFromServer[i].TASK;
                container.appendChild(task);
                task.style.fontSize = "1em";
                document.querySelector(".post_results").appendChild(container);
            }

         }

         function showPoints(arrayFromServer,userLoggedIn){
        let pointsArray = [];
            //document.querySelector(".post_results").innerHTML="";
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