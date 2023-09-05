<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Admin Login</title>
    <style>
        /* Custom CSS styles can be added here */
        .container {
            margin-top: 100px;
        }
        /* Custom style for input fields */
        .form-control {
            border-radius: 10px;
        }
        /* Style for the Login button */
        .btn-primary {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="display-4">Admin Login</h2>
        <form action="admin_authenticate.php" method="post" class="">
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
    <!-- Add Bootstrap JS and Popper.js scripts at the end of the body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
</body>
</html>
