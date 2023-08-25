<?php
require_once('dbConnection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

    // Data validation
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    
    // Regular expression patterns
    $usernamePattern = "/^[a-zA-Z0-9_]+$/";
    $passwordPattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/"; // At least 8 characters, 1 uppercase, 1 lowercase, 1 digit
    $emailPattern = "/^\S+@\S+\.\S+$/";
    
    if (!preg_match($usernamePattern, $username)) {
        die("Invalid username format");
    }
    
    if (!preg_match($passwordPattern, $password)) {
        die("Invalid password format");
    }
    
    if (!preg_match($emailPattern, $email)) {
        die("Invalid email format");
    }
    
    // Insert data into the database
    $insertQuery = "INSERT INTO user (user_name, user_password, email, dob) VALUES ('$username', '$password', '$email', '$dob')";
    
    if ($connection->query($insertQuery) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $connection->error;
    }
    
    // Close the connection
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.html">go to home page</a>
</body>
</html>