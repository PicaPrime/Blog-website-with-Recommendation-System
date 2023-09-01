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

// Handle content deletion
if (isset($_GET['delete_content_id'])) {
    $delete_content_id = $_GET['delete_content_id'];

    // Delete content from content table
    $delete_content_sql = "DELETE FROM content WHERE content_id = $delete_content_id";
    $conn->query($delete_content_sql);

    // Delete content tags from content_tag table
    $delete_content_tags_sql = "DELETE FROM content_tag WHERE content_id = $delete_content_id";
    $conn->query($delete_content_tags_sql);

    echo "Content with ID $delete_content_id and associated tags deleted successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Content</title>
</head>
<body>
    <h2>Delete Content</h2>
    <?php
    // Fetch content data from the database
    $content_sql = "SELECT content_id, title FROM content";
    $content_result = $conn->query($content_sql);

    while ($content_row = $content_result->fetch_assoc()) {
        echo '<p><strong>' . $content_row["title"] . '</strong> (<a href="?delete_content_id=' . $content_row["content_id"] . '">Delete</a>)</p>';
    }
    ?>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
