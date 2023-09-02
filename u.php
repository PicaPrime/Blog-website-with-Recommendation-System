<!DOCTYPE html>
<html>
<head>
    <title>View Images</title>
</head>
<body>
    <h1>View Images</h1>

    <?php
    // Database connection information (modify as needed)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve image data from the database
    $sql = "SELECT image_id, image_name, image_data FROM image_storage";
    $result = $conn->query($sql);

    // Display each image
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $image_id = $row["image_id"];
            $image_name = $row["image_name"];
            $image_data = $row["image_data"];

            // Display the image using base64 encoding
            echo "<h2>$image_name</h2>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($image_data) . "' /><br>";
        }
    } else {
        echo "No images found.";
    }

    // Close the database connection
    $conn->close();
    ?>

    <a href="insert_image.php">Upload New Image</a>
</body>
</html>
