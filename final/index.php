<?php
    session_start();
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<p>Hello, $username!</p>";
    } else {
        echo "<p>Please log in!</p>";
    }
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Climate Changes</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<body>
 



<section class="hello">

  
    <div class="topnav">
        <h2 style="float:left"><a href="index.html">Home</a></h2>
        <h2><a href="">Feed</a></h2>
        <h2><a href="">Quiz</a></h2>
        <!-- <h2><a href="">Form</a></h2> -->
    
    </div>

    <div class="hello-info">
        <h1>Climate Changes</h1>
        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        <h3><a href="">More Info</a></h3>
        


    </div>



</section>


<!-- <section class="map">
    <h2>Map of Canada</h2>
    <h1>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Error nihil nostrum a corporis ipsam 
        fuga consequuntur recusandae voluptas? Architecto corrupti nostrum earum eius sint quam ea nobis magni nulla aperiam.</h1>
        <div id="map" style="width: 50%; height: 400px;"></div> -->


   



</section>

<section class="bout">
    <h2>About us</h2>
    <div class="main">

        <!-- <div class="main-each">
            <h1>Form</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto blanditiis adipisci culpa consequuntur sed itaque, aperiam animi repellendus alias magni! Cum temporibus esse vel dolores illum magnam impedit totam enim.</p>
        </div> -->

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
<footer>

    <h2>Contact Us</h2>

    <section class="contact">
        <section class="contact-us">
            <p>Ines Pioselli</p>
            <p>Huyen Tran </p>
        </section>
    
        <section class="contact-us">
            <h2>&#169;Cart 351 Prototype</h2>
        </section>
    </section>



<script>

//const map = L.map('map').setView([52.93, -73.54], 15);
   // let marker = L.marker([52.93, -73.54]).addTo(map);
    //let circle = L.circle([52.93, -73.54], {
  //  color: 'red',
  //  fillColor: '#f03',
   // fillOpacity: 0.5,
   // radius: 5000
//}).addTo(map);

	//const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		//maxZoom: 19,
		//attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	//}).addTo(map);

</script>
</body>
</html>
