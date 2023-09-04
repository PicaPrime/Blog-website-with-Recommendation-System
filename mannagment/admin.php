<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
    <!-- Include Bootstrap CSS from a CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Your custom CSS styles -->
    <style>
        /* Add your custom CSS styles here */
        .admin-buttons {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Admin Panel</h1>

        <?php
            $name  = $_SESSION["admin_username"];
            echo "<h3>Wellcome $name <h3>";
        ?>
        
        <div class="admin-buttons">
            <!-- Insert Button -->
            <a href="addContent.php" class="btn btn-primary mr-2">Insert Data</a>
            
            <!-- Delete Button -->
            <a href="delete.php" class="btn btn-danger mr-2">Delete Data</a>
            
            <!-- Update Button -->
            <a href="update.php" class="btn btn-warning mr-2">Update Data</a>
            
            <!-- View All Button -->
            <a href="adminView.php" class="btn btn-success">View All Data</a>
        </div>
    </div>
    
    <!-- Include Bootstrap JavaScript (optional, for Bootstrap features like modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
