<?php
// Replace these variables with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch content data along with related information
$sql = "SELECT c.*, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags, AVG(cr.AverageRating) AS average_rating, COUNT(co.comment_id) AS comment_count
        FROM content c
        LEFT JOIN content_tag ct ON c.content_id = ct.content_id
        LEFT JOIN tag t ON ct.tag_id = t.tag_id
        LEFT JOIN content_rating cr ON c.content_id = cr.content_id
        LEFT JOIN comments co ON c.content_id = co.content_id
        GROUP BY c.content_id
        ORDER BY c.content_date DESC";

$result = $conn->query($sql);

if (!$result) {
    echo "Error: " . $conn->error;
} else {
    // Output content data in a table
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "    <meta charset='UTF-8'>";
    echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "    <title>View Content</title>";
    echo "</head>";
    echo "<body>";
    echo "    <h2>View Content</h2>";
    echo "    <table border='1'>";
    echo "        <tr>";
    echo "            <th>Title</th>";
    echo "            <th>Author</th>";
    echo "            <th>Content Date</th>";
    echo "            <th>Tags</th>";
    echo "            <th>Average Rating</th>";
    echo "            <th>Comment Count</th>";
    echo "        </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "        <tr>";
        echo "            <td>" . $row["title"] . "</td>";
        echo "            <td>" . $row["author"] . "</td>";
        echo "            <td>" . $row["content_date"] . "</td>";
        echo "            <td>" . $row["tags"] . "</td>";
        echo "            <td>" . round($row["average_rating"], 2) . "</td>";
        echo "            <td>" . $row["comment_count"] . "</td>";
        echo "        </tr>";
    }
    
    echo "    </table>";
    echo "</body>";
    echo "</html>";
}

// Close the database connection
$conn->close();
?>
