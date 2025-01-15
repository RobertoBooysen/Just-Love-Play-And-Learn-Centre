<?php
//Creating the connection to the database(W3Schools,2023)
session_start();

$servername = "your_server_name";  // Replace with your actual server name
$user_name = "your_username";      // Replace with your actual username
$password = "your_password";      // Replace with your actual password
$dbname = "your_database_name";   // Replace with your actual database name

//Create connection(W3Schools,2023)
$conn = new mysqli($servername, $user_name, $password, $dbname);

//Check connection(W3Schools,2023)
if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully <br>";

?>