<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "blog");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Initialize variables
$content_id = "";
$title = "";
$author = "";
$content_date = "";
$sub_title = "";
$adult_tag = "";
$body = "";

// Check if a content title is selected
if (isset($_POST['select_title'])) {
    $content_id = $_POST['select_title'];

    // Retrieve content information from the database
    $sql = "SELECT * FROM `content` WHERE `content_id` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $content_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Populate form fields with content information
            $title = $row['title'];
            $author = $row['author'];
            $content_date = $row['content_date'];
            $sub_title = $row['sub_title'];
            $adult_tag = $row['adult_tag'];
            $body = $row['body'];
        } else {
            echo "Content not found.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle content update
if (isset($_POST['update_content'])) {
    $content_id = $_POST['content_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content_date = $_POST['content_date'];
    $sub_title = $_POST['sub_title'];
    $adult_tag = $_POST['adult_tag'];
    $body = $_POST['body'];

    // Update content in the database
    $sql = "UPDATE `content` SET `title` = ?, `author` = ?, `content_date` = ?, `sub_title` = ?, `adult_tag` = ?, `body` = ? WHERE `content_id` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssisi", $title, $author, $content_date, $sub_title, $adult_tag, $body, $content_id);

    if ($stmt->execute()) {
        echo "Content updated successfully.";
    } else {
        echo "Error updating content: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Content</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        h1 {
            color: #007bff;
        }

        label {
            font-weight: bold;
        }

        select,
        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        hr {
            border-top: 2px solid #ccc;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        /* Add more custom styles here as needed */
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Content</h1>
        <form method="post">
            <div class="form-group">
                <label for="select_title">Select Content Title:</label>
                <select name="select_title" class="form-control">
                    <?php
                    // Retrieve a list of content titles
                    $sql = "SELECT `content_id`, `title` FROM `content`";
                    $result = $mysqli->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        $selected = ($row['content_id'] == $content_id) ? 'selected' : '';
                        echo "<option value='{$row['content_id']}' $selected>{$row['title']}</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="submit" value="Select" class="btn btn-primary">
        </form>

        <hr>

        <form method="post">
            <input type="hidden" name="content_id" value="<?php echo $content_id; ?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" value="<?php echo $title; ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" name="author" value="<?php echo $author; ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="content_date">Content Date:</label>
                <input type="date" name="content_date" value="<?php echo $content_date; ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="sub_title">Sub Title:</label>
                <input type="text" name="sub_title" value="<?php echo $sub_title; ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="adult_tag">Adult Tag:</label>
                <input type="number" name="adult_tag" value="<?php echo $adult_tag; ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" rows="4" cols="50" class="form-control" required><?php echo $body; ?></textarea>
            </div>

            <input type="submit" name="update_content" value="Update Content" class="btn btn-primary">
        </form>
    </div>

    <!-- Include Bootstrap JS and Popper.js scripts at the end of the body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
</body>
</html>

<?php
$mysqli->close();
?>
