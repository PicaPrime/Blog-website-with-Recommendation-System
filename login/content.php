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

        $q = "select * from content_tag where content_id = $content_id";
        $tagList  = $connection->query($q);
        $tagArr = [];

        if ($tagList->num_rows > 0) {
            while($row = $tagList->fetch_assoc()) {
                $tagArr[] = $row['tag_id'];
            }
             
        }          
        
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo '<h1>' . $row["title"] . '</h1>';
            echo '<p>' . $row["body"] . '</p>';
        }

        if (isset($_COOKIE["user_id"])) {
            $stored_user_id = $_COOKIE["user_id"];

            for($i= 0 ; $i< count($tagArr); $i++){
                $t = $tagArr[$i];
                $query = "SELECT * FROM user_tag WHERE user_id = $stored_user_id and tag_id = $t";
                $r = $connection->query($query);

                if($r->num_rows == 0){
                    $query = "INSERT INTO user_tag (user_id, tag_id, tag_priority) VALUES ($stored_user_id, $t, 1);";
                    $connection->query($query);
                }
                else {
                    // increast the tag priority and update the row
                    $u = $r->fetch_assoc();
                    $priority = $u['tag_priority'];
                    $priority++;
                    $query = "UPDATE user_tag
                    SET tag_priority = $priority -- Set the new value for tag_priority
                    WHERE user_id = $stored_user_id AND tag_id = $t; -- Specify the condition to identify the record
                    ";
                    $connection->query($query);
                }
              }

            // Close the connection
            $connection->close();
        } else {
            echo "please log in or sign up";
        }
    }
    ?>

</body>

</html>