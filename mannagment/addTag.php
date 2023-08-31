<?php
// Replace these variables with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$tag_name = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tag_name = $_POST["tag_name"];

    // Insert new tag into the database
    $insert_tag_sql = "INSERT INTO tag (name) VALUES ('$tag_name')";
    $conn->query($insert_tag_sql);

    echo "Tag '$tag_name' added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Tag</title>
</head>
<body>
    <h2>Add Tag</h2>
    <form method="post">
        <label for="tag_name">Tag Name:</label><br>
        <input type="text" name="tag_name" required><br>
        <br>
        <input type="submit" value="Add Tag">
    </form>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
