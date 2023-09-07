<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'blog';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    $user_id = 0;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(!isset($_COOKIE["user_id"])) {
        $user_id = $_COOKIE["user_id"];
        echo $user_id;
    }
    else {
        require_once('dbConnection.php');
        $query = "SELECT * FROM user ORDER BY user_id DESC LIMIT 1;";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $user_id = $row["user_id"];
    }
    $tag_priority = 1; // Set the tag priority to 1

    if (isset($_POST['tags'])) {
        $selected_tags = $_POST['tags'];

        foreach ($selected_tags as $tag_id) {
            // Insert selected tags into the user_tag table with tag_priority 1
            $insert_query = "INSERT INTO user_tag (user_id, tag_id, tag_priority) VALUES ('$user_id', '$tag_id', '$tag_priority')";
            $conn->query($insert_query);
        }

        echo "Tags inserted successfully.";
        header("Location: signUpContent.php");
    } else {
        echo "No tags selected.";
    }

    $conn->close();
}
?>
