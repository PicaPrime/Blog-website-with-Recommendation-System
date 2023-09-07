<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Rate Content</title>
</head>

<body>

    <div class="container mt-5">
        <h1>Rate Content</h1>

        <?php
        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Handle the rating submission
            $content_id = $_POST["content_id"];
            $rating = $_POST["rating"];

            // Insert the rating into the database (you should add your database connection logic here)

            // Provide feedback to the user
            echo '<div class="alert alert-success" role="alert">Thank you for rating the content!</div>';
        } else {
            // Display the form to select content and rate it
            require_once('dbConnection.php'); // Include your database connection code

            // Retrieve the list of content titles from the database
            $sql = "SELECT content_id, title FROM content";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<form method="POST">';
                echo '<div class="form-group">';
                echo '<label for="content_id">Select Content:</label>';
                echo '<select class="form-control" id="content_id" name="content_id">';
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["content_id"] . '">' . $row["title"] . '</option>';
                }
                echo '</select>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="rating">Rate Content (1-10):</label>';
                echo '<input type="range" class="form-control-range" id="rating" name="rating" min="1" max="10">';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary">Submit Rating</button>';
                echo '</form>';
            } else {
                echo '<p>No content titles found.</p>';
            }

            // Close the database connection
            $conn->close();
        }
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$host = "localhost"; // Change this to your database host
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "blog"; // Change this to your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the rating submission
    $content_id = $_POST["content_id"];
    $rating = $_POST["rating"];

    // Check if the content_id and rating are valid
    if (!empty($content_id) && !empty($rating)) {
        // Perform data validation if needed

        // Insert the rating into the database
        $sql = "select * from content_rating where content_id = $content_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $newRating = 0.0;
            while ($row = $result->fetch_assoc()) {
                $newRating = ($row['AverageRating'] + $rating) / 2;
            }
            $sql = "UPDATE content_rating
            SET AverageRating = $newRating
            WHERE content_id = $content_id;
            ";
            $result = $conn->query($sql);
        } else {
            $sql = "INSERT INTO content_rating (content_id, AverageRating, rating_date) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ii", $content_id, $rating);
                if ($stmt->execute()) {
                    echo '<div class="alert alert-success" role="alert">Thank you for rating the content!</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error: Rating submission failed.</div>';
                }
                $stmt->close();
            } else {
                echo '<div class="alert alert-danger" role="alert">Error: Rating submission failed.</div>';
            }
        }
    }
}

$linkText = "go to timeline"; // The text you want to display as the link
$targetURL = "signUpContent.php"; // The URL you want the link to point to

echo '<a class="container mt-5" href="' . $targetURL . '">' . $linkText . '</a>';


// Close the database connection
$conn->close();
?>