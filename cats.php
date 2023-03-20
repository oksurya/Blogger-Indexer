<?php

// URL of the Blogger JSON feed
$url = "https://www.blogger.com/feeds/123/posts/default?alt=json";

// Get the category from the URL parameter
$category = $_GET['id'];

// Get the JSON data from the URL
$json = file_get_contents($url);

// Decode the JSON data into a PHP array
$data = json_decode($json, true);

// Create an array to store the posts for the specified category
$posts = array();

// Loop through the array of posts
foreach ($data['feed']['entry'] as $post) {
    // Loop through the array of categories for each post
    foreach ($post['category'] as $postCategory) {
        // If the category matches the specified category, add the post to the posts array
        if ($postCategory['term'] == $category) {
            $posts[] = $post;
            break;
        }
    }
}

// Display the posts
echo "<h2>Posts in category '" . $category . "'</h2>";
foreach ($posts as $post) {
    echo "<h3>" . $post['title']['$t'] . "</h3>";
    echo "<hr>";
}

?>
