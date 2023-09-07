<!DOCTYPE html>
<html>
<head>
    <title>Select Tags</title>
</head>
<body>
    <h1>Select Tags for User</h1>

    <?php
    // Establish a database connection (replace with your database credentials)
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'blog';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch available tags
    $tag_query = "SELECT * FROM tag";
    $result = $conn->query($tag_query);

    if ($result->num_rows > 0) {
        echo "<form method='post' action='process_tags.php'>";
        while ($row = $result->fetch_assoc()) {
            echo "<input type='checkbox' name='tags[]' value='" . $row['tag_id'] . "'>" . $row['name'] . "<br>";
        }
        echo "<input type='submit' value='Submit'>";
        echo "</form>";
    } else {
        echo "No tags selected.";
    }
    $conn->close();
    ?>

</body>
</html>
