<?php
session_start();

require_once('dbConnection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $admin_username = $_POST["admin_username"];
    $admin_password = $_POST["admin_password"];

    // Perform input validation and sanitization here if needed

    // Check admin credentials
    $query = "SELECT * FROM admin WHERE admin_username = ? AND admin_password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $admin_username, $admin_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Admin login successful
        $_SESSION["admin_username"] = $admin_username;
        header("Location: admin.php"); // Redirect to the admin dashboard
        exit();
    } else {
        // Invalid admin credentials
        $_SESSION["login_error"] = "Invalid username or password";
        header("Location: adminlogin.php"); // Redirect back to the login page
        exit();
    }
}

// Close the database connection
$conn->close();
?>
