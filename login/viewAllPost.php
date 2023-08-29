<?php
require_once('C:/xampp/htdocs/R_blog/dbConnection.php');

$sql = "SELECT *
    FROM content";
    
$result = $connection->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<a href="content.php?id=' . $row["content_id"] . '">' . $row["title"] . '</a><br>';
  }
} else {
  echo "0 results";
}
$connection->close();


?>