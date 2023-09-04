<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection (replace with your database credentials)
    $mysqli = new mysqli("hostname", "username", "password", "database_name");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Retrieve user input from the registration form
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $country = $_POST['country'];

    // Hash the user's password for security (you should use a more secure method)
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO `user` (`user_name`, `user_password`, `email`, `dob`, `country`)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssss", $user_name, $hashed_password, $email, $dob, $country);

    if ($stmt->execute()) {
        echo "Registration successful. You can now log in.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>
