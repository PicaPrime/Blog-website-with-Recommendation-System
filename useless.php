<!DOCTYPE html>
<html>
<head>
  <title>View Content Titles</title>
</head>
<body>
  <h1>View Content Titles</h1>
  <form action="addTag.php" method="post">
    <label for="content_id">Select a Content Title:</label>
    <select id="content_id" name="content_id">
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

      // Fetch content titles from the 'content' table
      $query = "SELECT `content_id`, `title` FROM `content`";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row["content_id"] . '">' . $row["title"] . '</option>';
          }
      }

      $q = "select * from content_tag";
      $conn->close();
      ?>
    </select><br>

    <input type="submit" value="View Content">
  </form>
</body>
</html>
