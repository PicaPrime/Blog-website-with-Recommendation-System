<?php

$showAgeRestrictedContent = true;
if (isset($_COOKIE["user_age"])) {
    $userAge = intval($_COOKIE["user_age"]);
    
    if ($userAge > 18) {
        $showAgeRestrictedContent = true; 
    }
}

require_once('dbConnection.php');

if ($showAgeRestrictedContent) {
    $sql = "SELECT * FROM content natural join content_rating ORDER BY AverageRating DESC LIMIT 10";
} else {
    $sql = "SELECT * FROM content natural join content_rating WHERE adult_tag = 0 ORDER BY AverageRating DESC LIMIT 10";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Most Rated Content Titles</h1>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo '<a href="content.php?id=' . $row["content_id"] . '">' . $row["title"] . '</a><br>';
    }
    echo "</ul>";
} else {
    echo "No content titles found.";
}

$user_id = $_COOKIE["user_id"];

if ($showAgeRestrictedContent) {
    $sql = "SELECT * FROM content natural join content_tag natural join tag natural join user_tag where user_id = $user_id  ORDER BY tag_priority DESC LIMIT 5";
} else {
    $sql = "SELECT * FROM content natural join content_tag natural join tag natural join user_tag where user_id = $user_id and adult_tag = 0 ORDER BY tag_priority DESC LIMIT 5";

}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Based on your Pervious Interaction</h1>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo '<a href="content.php?id=' . $row["content_id"] . '">' . $row["title"] . '</a><br>';
    }
    echo "</ul>";
} else {
    echo "No content titles found.";
}


if ($showAgeRestrictedContent) {
    $sql = "SELECT * FROM content natural join tag ORDER BY popularity_points DESC LIMIT 5";
} else {
    $sql = "SELECT * FROM content natural join tag where adult_tag = 0 ORDER BY popularity_points DESC LIMIT 5";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Popular right now</h1>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo '<a href="content.php?id=' . $row["content_id"] . '">' . $row["title"] . '</a><br>';
    }
    echo "</ul>";
} else {
    echo "No content titles found.";
}
// Close the database connection
$conn->close();

echo "<a href='viewAllPost.php'>view all post</a>";
?>
