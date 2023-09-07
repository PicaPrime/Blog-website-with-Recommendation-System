<?php

require_once('dbConnection.php');

$title = $author = $content_date = $sub_title = $body = $tag_ids = [];
$tag_name = '';
$adult_tag = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_content"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $content_date = $_POST["content_date"];
    $sub_title = $_POST["sub_title"];
    $body = $_POST["body"];
    $tag_ids = $_POST["tag_ids"];
    $adult_tag = $_POST["adult_tag"];

    $insert_content_sql = "INSERT INTO content (title, author, content_date, sub_title, body, adult_tag)
                          VALUES ('$title', '$author', '$content_date', '$sub_title', '$body', '$adult_tag')";
    if($conn->query($insert_content_sql)){
        echo "<h4>Content added<h4><br>";
    }
    else{
        echo "<h4>Content not added<h4><br>";
    }


    $content_id = $conn->insert_id;

    foreach ($tag_ids as $tag_id) {
        $insert_content_tag_sql = "INSERT INTO content_tag (content_id, tag_id) VALUES ($content_id, $tag_id)";
        $conn->query($insert_content_tag_sql);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_tag"])) {
    $tag_name = $_POST["tag_name"];

    $insert_tag_sql = "INSERT INTO tag (name) VALUES ('$tag_name')";
    $conn->query($insert_tag_sql);

    echo "Tag '$tag_name' added successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Content and Tag</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        h2 {
            color: #007bff;
            margin-top: 0;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body class="container mt-4">

<h2>Add Tag</h2>
    <form method="post" class="form-label">
        <div class="mb-3">
            <label for="tag_name" class="form-label">Tag Name:</label>
            <input type="text" name="tag_name" class="form-control" required>
        </div>
        <input type="submit" name="add_tag" value="Add Tag" class="btn btn-primary">
    </form><br>
    <h2>Add Content</h2>
    <form method="post" class="form-label">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author:</label>
            <input type="text" name="author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content_date" class="form-label">Content Date:</label>
            <input type="date" name="content_date" class="form-control">
        </div>
        <div class="mb-3">
            <label for="sub_title" class="form-label">Sub Title:</label>
            <input type="text" name="sub_title" class="form-control">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body:</label>
            <textarea name="body" rows="4" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="tag_ids" class="form-label">Select Tags:</label><br>
            <?php
            $tag_sql = "SELECT tag_id, name FROM tag";
            $tag_result = $conn->query($tag_sql);
            
            while ($tag_row = $tag_result->fetch_assoc()) {
                echo '<input type="checkbox" name="tag_ids[]" value="' . $tag_row["tag_id"] . '">' . $tag_row["name"] . '<br>';
            }
            ?>
        </div>
        <div class="mb-3">
            <label for="adult_tag" class="form-label">Adult Content:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="adult_tag" id="adult_tag_0" value="0" checked>
                <label class="form-check-label" for="adult_tag_0">No</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="adult_tag" id="adult_tag_1" value="1">
                <label class="form-check-label" for="adult_tag_1">Yes</label>
            </div>
        </div>
        <input type="submit" name="add_content" value="Add Content" class="btn btn-primary">
    </form>

    

    <!-- Add Bootstrap JS and Popper.js scripts at the end of the body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min


<?php

$conn->close();
?>
