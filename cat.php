<?php

// URL of the Blogger JSON feed
$url = "https://www.blogger.com/feeds/123/posts/default?alt=json";

// Get the JSON data from the URL
$json = file_get_contents($url);

// Decode the JSON data into a PHP array
$data = json_decode($json, true);

// Create an array to store the categories
$categories = array();

// Loop through the array of posts
foreach ($data['feed']['entry'] as $post) {
    // Loop through the array of categories for each post
    foreach ($post['category'] as $category) {
        // Add the category to the categories array if it doesn't already exist
        if (!in_array($category['term'], $categories)) {
            $categories[] = $category['term'];
        }
    }
}

// Sort the categories array in alphabetical order
sort($categories);

// Display the categories
echo "<h2>Categories</h2>";
echo "<ul>";
foreach ($categories as $category) {
    echo "<li><a href='cats.php?id=" . urlencode($category) . "'>" . $category . "</a></li>";}
echo "</ul>";

?>
