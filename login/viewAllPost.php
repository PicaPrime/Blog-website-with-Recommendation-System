<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Content Titles</title>
</head>
<body>

<div class="container mt-5">
    <h1>Content Titles</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Published date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once('C:/xampp/htdocs/R_blog/dbConnection.php');

            $sql = "SELECT *
                FROM content";

            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["content_id"] . '</td>';
                    echo '<td><a href="content.php?id=' . $row["content_id"] . '">' . $row["title"] . '</a></td>';
                    echo '<td>' . $row["author"] . '</td>';
                    echo '<td>' . $row["content_date"] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="2">0 results</td></tr>';
            }
            $connection->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
