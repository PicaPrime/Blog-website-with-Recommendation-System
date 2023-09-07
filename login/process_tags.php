<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish a database connection (replace with your database credentials)
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'blog';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the selected tags from the form
    $user_id = 1; // Replace with the actual user ID
    $tag_priority = 1; // Set the tag priority to 1

    if (isset($_POST['tags'])) {
        $selected_tags = $_POST['tags'];

        foreach ($selected_tags as $tag_id) {
            // Insert selected tags into the user_tag table with tag_priority 1
            $insert_query = "INSERT INTO user_tag (user_id, tag_id, tag_priority) VALUES ('$user_id', '$tag_id', '$tag_priority')";
            $conn->query($insert_query);
        }

        echo "Tags inserted successfully.";
    } else {
        echo "No tags selected.";
    }

    $conn->close();
}
?>
