<?php
// Establish a database connection (replace with your actual database connection code)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$title = $_POST['title'];
$author = $_POST['author'];
$content_date = $_POST['content_date'];
$sub_title = $_POST['sub_title'];
$body = $_POST['body'];

// Insert data into the 'content' table
$sql = "INSERT INTO `content` (`title`, `author`, `content_date`, `sub_title`, `body`)
        VALUES ('$title', '$author', '$content_date', '$sub_title', '$body')";

if ($conn->query($sql) === TRUE) {
    echo "New content added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
