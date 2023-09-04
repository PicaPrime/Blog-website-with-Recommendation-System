<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Add your custom CSS styles if needed -->
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form action="admin_authenticate.php" method="post">
            <div class="form-group">
                <label for="admin_username">Username:</label>
                <input type="text" class="form-control" id="admin_username" name="admin_username" required>
            </div>
            <div class="form-group">
                <label for="admin_password">Password:</label>
                <input type="password" class="form-control" id="admin_password" name="admin_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
