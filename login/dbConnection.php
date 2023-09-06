<?php
// Database configuration
$host = "localhost"; // Change this to your database host
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "blog"; // Change this to your database name

// Create a connection
$connection = new mysqli($host, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}



// Close the connection
// $connection->close();
?>