<?php

require_once('dbConnection.php');

$title = $author = $content_date = $sub_title = $body = $tag_ids = [];
$tag_name = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_content"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $content_date = $_POST["content_date"];
    $sub_title = $_POST["sub_title"];
    $body = $_POST["body"];
    $tag_ids = $_POST["tag_ids"];

    $insert_content_sql = "INSERT INTO content (title, author, content_date, sub_title, body)
                          VALUES ('$title', '$author', '$content_date', '$sub_title', '$body')";
    $conn->query($insert_content_sql);

    $content_id = $conn->insert_id;

    foreach ($tag_ids as $tag_id) {
        $insert_content_tag_sql = "INSERT INTO content_tag (content_id, tag_id) VALUES ($content_id, $tag_id)";
        $conn->query($insert_content_tag_sql);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_tag"])) {
    $tag_name = $_POST["tag_name"];

    $regex = "/^[a-zA-Z0-9_-]{1,255}$/";
    if (!preg_match($regex, $tag_name)) {
        echo "Invalid tag name. Tag name must be alphanumeric and between 1 and 255 characters long.";
        return;
    }

    $insert_tag_sql = "INSERT INTO tag (name) VALUES ('$tag_name')";
    $conn->query($insert_tag_sql);

    echo "Tag '$tag_name' added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Content and Tag</title>
</head>
<body>
    <h2>Add Content</h2>
    <form method="post">
        <label for="title">Title:</label><br>
        <input type="text" name="title" required><br>
        <label for="author">Author:</label><br>
        <input type="text" name="author" required><br>
        <label for="content_date">Content Date:</label><br>
        <input type="date" name="content_date"><br>
        <label for="sub_title">Sub Title:</label><br>
        <input type="text" name="sub_title"><br>
        <label for="body">Body:</label><br>
        <textarea name="body" rows="4" required></textarea><br>
        <label for="tag_ids">Select Tags:</label><br>
        <?php

        $tag_sql = "SELECT tag_id, name FROM tag";
        $tag_result = $conn->query($tag_sql);

        while ($tag_row = $tag_result->fetch_assoc()) {
            echo '<input type="checkbox" name="tag_ids[]" value="' . $tag_row["tag_id"] . '">' . $tag_row["name"] . '<br>';
        }
        ?>
        <br>
        <input type="submit" name="add_content" value="Add Content">
    </form>

    <h2>Add Tag</h2>
    <form method="post">
        <label for="tag_name">Tag Name:</label><br>
        <input type="text" name="tag_name" required><br>
        <br>
        <input type="submit" name="add_tag" value="Add Tag">
    </form>
</body>
</html>

<?php

$conn->close();
?>
