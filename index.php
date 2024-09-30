<?php
include 'utils.php'; // Include utils.php to use its functions

// Function to load posts from JSON file
$posts = loadPostsFromJSON('posts.json');

// Function to display all blog post titles as links
function displayPosts($posts) {
    foreach ($posts as $index => $post) {
        echo "<div class='card my-3'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'><a href='detail.php?post_id=$index'>{$post['title']}</a></h5>";
        echo "<p class='card-text'>By {$post['author']} on {$post['date']}</p>";
        echo "</div>";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Index</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Blog Posts</h1>
        <a href="upload.php" class="btn btn-success mb-3">Make Post</a>
        <?php displayPosts($posts); ?>
    </div>
</body>
</html>
