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
$title = $author = $content_date = $sub_title = $body = $tag_ids = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $content_date = $_POST["content_date"];
    $sub_title = $_POST["sub_title"];
    $body = $_POST["body"];
    $tag_ids = $_POST["tag_ids"];

    // Insert content into the database
    $insert_content_sql = "INSERT INTO content (title, author, content_date, sub_title, body)
                          VALUES ('$title', '$author', '$content_date', '$sub_title', '$body')";
    $conn->query($insert_content_sql);

    // Get the last inserted content ID
    $content_id = $conn->insert_id;

    // Insert content tags into the content_tag table
    foreach ($tag_ids as $tag_id) {
        $insert_content_tag_sql = "INSERT INTO content_tag (content_id, tag_id) VALUES ($content_id, $tag_id)";
        $conn->query($insert_content_tag_sql);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Content</title>
</head>
<body>
    <h2>Add Content</h2>
    <form method="post">
        <label for="title">Title:</label><br>
        <input type="text" name="title" required><br>
        <label for="author">Author:</label><br>
        <input type="text" name="author" required><br>
        <label for="content_date">Content Date:</label><br>
        <input type="date" name="content_date"><br>
        <label for="sub_title">Sub Title:</label><br>
        <input type="text" name="sub_title"><br>
        <label for="body">Body:</label><br>
        <textarea name="body" rows="4" required></textarea><br>
        <label for="tag_ids">Select Tags:</label><br>
        <?php
        // Fetch tag data from the database
        $tag_sql = "SELECT tag_id, name FROM tag";
        $tag_result = $conn->query($tag_sql);

        while ($tag_row = $tag_result->fetch_assoc()) {
            echo '<input type="checkbox" name="tag_ids[]" value="' . $tag_row["tag_id"] . '">' . $tag_row["name"] . '<br>';
        }
        ?>
        <br>
        <input type="submit" value="Add Content">
    </form>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
