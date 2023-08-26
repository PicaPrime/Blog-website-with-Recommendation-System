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
        } 

        if (isset($_COOKIE["user_id"])) {
            $stored_user_id = $_COOKIE["user_id"];
            echo $stored_user_id;

            $sql = "select * from user_tag where user_id = '$stored_user_id' and tag_id = '$content_id';";
            $result = $connection->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["user_id"]. " - Name: " . $row["tag_id"]. " " . $row["tag_priority"]. "<br>";
              }

            if ($result->num_rows == 0) {
                $sql = "INSERT INTO `user_tag` (`user_id`, `tag_id`, `tag_priority`) VALUES ($stored_user_id, $content_id, 1);";
                $result = $connection->query($sql);
            }
            else if ($result->num_rows > 0) {
                // output data of each row
                $newPriority = 0;
                while($row = $result->fetch_assoc()) {
                    $newPriority = $row["tag_priority"];
                    $newPriority =$newPriority + 1;
                }
                
                $sql = "INSERT INTO `user_tag` (`tag_priority`) VALUES ($newPriority) where user_id = '$stored_user_id' and tag_id = '$content_id';";
                $result = $connection->query($sql);
                echo "successfull";
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