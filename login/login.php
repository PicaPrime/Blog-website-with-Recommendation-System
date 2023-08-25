<?php
require_once('C:/xampp/htdocs/R_blog/dbConnection.php');
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
        // Assume $user_id is the user's ID you want to store in the cookie
        $row = $result->fetch_assoc();
        $user_id = $row["user_id"];

        // Set the cookie with the user_id
        $cookie_name = "user_id";
        $cookie_value = $user_id;
        $cookie_expiration = time() + (86400 * 30); // Cookie will expire in 30 days
        $cookie_path = "/"; // Cookie is accessible across the entire domain

        setcookie($cookie_name, $cookie_value, $cookie_expiration, $cookie_path);

        echo "Cookie 'user_id' is set with value $user_id";
        header("Location: viewAllPost.php");
    } else {
        // User not found, show error message
        echo "Invalid username or password.";
    }

    // Close the connection
    $connection->close();
}
