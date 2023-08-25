<!DOCTYPE html>
<html>

<head>
    <title>Full Content</title>
</head>

<body>

    <?php
    if (isset($_GET['id'])) {
        // Database configuration
        $host = "localhost"; // Change this to your database host
        $username = "root"; // Change this to your database username
        $password = ""; // Change this to your database password
        $database = "blog"; // Change this to your database name

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
        } else {
            echo "Content not found.";
        }


        if (isset($_COOKIE["user_id"])) {
            $stored_user_id = $_COOKIE["user_id"];

            $sql = "select * from user_tag where user_id = $stored_user_id;";
            $result = $connection->query($sql);

            if ($result->num_rows == 0) {
                $sql = "INSERT INTO `user_tag` (`user_id`, `tag_id`) VALUES ($stored_user_id, $content_id);";
                $sql = "select * from user_tag where user_id = $stored_user_id;";
                $result = $connection->query($sql);
                $row = $result->fetch_assoc();
                $row["tag_priority"]++;
                
            }
            else if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
                $row["tag_priority"]++;
            } else {
                echo "0 results";
            }
        } else {
            echo "User ID cookie not found.";
        }













        // Close the connection
        $connection->close();
    } else {
        echo "Invalid request.";
    }
    ?>

</body>

</html>