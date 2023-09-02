<!DOCTYPE html>
<html>
<head>
    <title>Insert Image</title>
</head>
<body>
    <h1>Insert Image</h1>

    <?php
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        // Check if a file was uploaded successfully
        if ($_FILES["image"]["error"] == 0) {
            $image_name = $_POST["image_name"];
            $image_data = file_get_contents($_FILES["image"]["tmp_name"]);

            // Prepare and execute an SQL query to insert the image data into the table
            $stmt = $conn->prepare("INSERT INTO image_storage (image_name, image_data) VALUES (?, ?)");
            $stmt->bind_param("sb", $image_name, $image_data);

            if ($stmt->execute()) {
                echo "Image inserted successfully!";
            } else {
                echo "Error inserting image: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error uploading file.";
        }

        // Close the database connection
        $conn->close();
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <label for="image_name">Image Name:</label>
        <input type="text" name="image_name" required><br>

        <label for="image">Choose Image:</label>
        <input type="file" name="image" accept="image/*" required><br>

        <input type="submit" value="Upload">
    </form>
</body>
</html>
