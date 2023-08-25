<?php
require_once('C:\xampp\htdocs\R_blog\dbConnection.php');

$sql = "SELECT *
    FROM content
    NATURAL JOIN content_tag
    NATURAL JOIN tag";
    
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo " - title: " . $row["title"]. "    ". $row["tag"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();


?>