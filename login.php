<?php
require_once('dbConnection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // User input
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Query to retrieve user data
    $query = "SELECT * FROM user WHERE user_name = '$username' AND user_password = '$password'";
    $result = $connection->query($query);
    
    if ($result->num_rows == 1) {
        // User found, set session and redirect to dashboard
        $_SESSION["username"] = $username;
        header("Location: index.html");
    } else {
        // User not found, show error message
        echo "Invalid username or password.";
    }
    
    // Close the connection
    $connection->close();
}
?>
