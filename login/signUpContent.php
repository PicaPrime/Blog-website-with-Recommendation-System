<?php
// Check if the "user_age" cookie is set
$showAgeRestrictedContent = true; // Default to showing age-restricted content
if (isset($_COOKIE["user_age"])) {
    $userAge = intval($_COOKIE["user_age"]);
    
    // Check if the user's age is below 18 (assuming age restriction is 18)
    if ($userAge < 18) {
        $showAgeRestrictedContent = false; // Don't show age-restricted content
    }
}

require_once('dbConnection.php');

// Query to fetch the most rated content titles (excluding age-restricted content if needed)
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

// Close the database connection
$conn->close();

echo "<a href='viewAllPost.php'>view all post</a>";
?>
