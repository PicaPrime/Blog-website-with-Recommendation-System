<!DOCTYPE html>
<html>

<head>
    <title>Full Content</title>
</head>

<body>

    <?php
    if (isset($_GET['id'])) {
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "blog";

        // Create a connection
        $connection = new mysqli($host, $username, $password, $database);

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Get content based on ID
        $content_id = $_GET['id'];
        $query = "SELECT * FROM content WHERE content_id = $content_id";
        $result = $connection->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo '<h1>' . $row["title"] . '</h1>';
            echo '<p>' . $row["body"] . '</p>';
        }

        if (isset($_COOKIE["user_id"])) {
            $stored_user_id = $_COOKIE["user_id"];
            echo $stored_user_id;



            // Close the connection
            $connection->close();
        } else {
            echo "Invalid request.";
        }
    }
    ?>

</body>

</html>