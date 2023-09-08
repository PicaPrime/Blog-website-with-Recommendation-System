<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Add custom CSS styles here */
        body {
            padding: 20px;
        }

        h1 {
            margin-top: 20px;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
        }

        ul li {
            margin-bottom: 10px;
        }
    </style>
    <title>Content Recommendations</title>
</head>
<body>

<div class="container">
    <?php
    $showAgeRestrictedContent = true;
    if (isset($_COOKIE["user_age"])) {
        $userAge = intval($_COOKIE["user_age"]);

        if ($userAge < 18) {
            $showAgeRestrictedContent = false;
        }
    }

    require_once('dbConnection.php');

    if ($showAgeRestrictedContent) {
        $sql = "SELECT * FROM content natural join content_rating ORDER BY AverageRating DESC LIMIT 5";
    } else {
        $sql = "SELECT * FROM content natural join content_rating WHERE adult_tag = 0 ORDER BY AverageRating DESC LIMIT 5";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h1>Most Rated Content Titles</h1>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo '<li><a href="content.php?id=' . $row["content_id"] . '">' . $row["title"] . '</a></li>';
        }
        echo "</ul>";
    } else {
        echo "<h1>No content titles found.</h1>";
    }

    $user_id = $_COOKIE["user_id"];

    if ($showAgeRestrictedContent) {
        $sql = "SELECT * FROM content natural join content_tag natural join tag natural join user_tag where user_id = $user_id  ORDER BY tag_priority DESC LIMIT 5";
    } else {
        $sql = "SELECT * FROM content natural join content_tag natural join tag natural join user_tag where user_id = $user_id and adult_tag = 0 ORDER BY tag_priority DESC LIMIT 5";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h1>Based on your Previous Interaction</h1>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo '<li><a href="content.php?id=' . $row["content_id"] . '">' . $row["title"] . '</a></li>';
        }
        echo "</ul>";
    } else {
        echo "<h1>No content titles found.</h1>";
    }

    if ($showAgeRestrictedContent) {
        $sql = "SELECT * FROM content natural join content_tag natural join tag ORDER BY tag.popularity_points DESC LIMIT 5";
        $sql = "SELECT DISTINCT c.content_id, c.title
        FROM content c
        JOIN content_tag ct ON c.content_id = ct.content_id
        JOIN tag t ON ct.tag_id = t.tag_id 
        ORDER by popularity_points 
        DESC LIMIT 5;";
    } else {
        $sql = "SELECT * FROM content natural join content_tag natural join tag where adult_tag = 0 ORDER BY tag.popularity_points DESC LIMIT 5";
        $sql = "SELECT DISTINCT c.content_id, c.title
        FROM content c
        JOIN content_tag ct ON c.content_id = ct.content_id
        JOIN tag t ON ct.tag_id = t.tag_id 
        where adult_tag = 0
        ORDER by popularity_points 
        DESC LIMIT 5;";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h1>Popular Right Now</h1>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo '<li><a href="content.php?id=' . $row["content_id"] . '">' . $row["title"] . '</a></li>';
        }
        echo "</ul>";
    } else {
        echo "<h1>No content titles found.</h1>";
    }

    // Close the database connection
    $conn->close();
    ?>

    <a href='viewAllPost.php' class="btn btn-primary">View All Posts</a>
    <a href="rate.php" class="btn btn-primary">Rate Content</a>
    <a href="logout.php" class="btn btn-primary">log out</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
