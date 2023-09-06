<?php
require_once('C:/xampp/htdocs/R_blog/dbConnection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE user_name = '$username' AND user_password = '$password'";
    $result = $connection->query($query);

    if ($result->num_rows == 1) {
        $_SESSION["username"] = $username;
        $row = $result->fetch_assoc();
        $user_id = $row["user_id"];

        $cookie_name = "user_id";
        $cookie_value = $user_id;
        $cookie_expiration = time() + (86400 * 30); 
        $cookie_path = "/";

        setcookie($cookie_name, $cookie_value, $cookie_expiration, $cookie_path);

        header("Location: signUpContent.php");
    } else {
        echo "<h1 class='container mt-5 text-danger'>Invalid username or password.</h1>";
    }

    // Close the connection
    $connection->close();
}
