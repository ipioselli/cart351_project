<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Save the description and coordinates to a file or database
    $data = "$description|$latitude|$longitude" . PHP_EOL;
    file_put_contents('points.txt', $data, FILE_APPEND | LOCK_EX);

    // Handle picture upload here

    echo "Point added successfully!";
} else {
    header('Location: map.html');
}
?>
