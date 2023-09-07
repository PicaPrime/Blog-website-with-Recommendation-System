<?php
// Check if the user is already logged in (has a user_id cookie)
if (isset($_COOKIE["user_id"])) {
    // Delete the user_id cookie by setting it to expire in the past
    setcookie("user_id", "", time() - 3600, "/");

    // Optionally, you can also delete other related cookies if needed

    // Provide a logout message or redirect to a login page
    echo "You have been logged out successfully.";
} else {
    // If the user does not have a user_id cookie, they are not logged in
    echo "You are not currently logged in.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Logout</title>
</head>
<body>

<div class="container mt-5">
    <!-- You can include additional content here, such as a message or a link to the login page -->
    <a href="login.html" class="btn btn-primary">Login</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
