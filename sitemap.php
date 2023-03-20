<?php

require_once 'config.php';

$blogid = $_GET['blogid'];


// URL of the Blogger JSON feed
$url = "https://www.blogger.com/feeds/$blogid/posts/default?alt=json&max-results=$max";

// Get the current page number from the URL query string
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the starting index for the current page
$startIndex = ($page - 1) * $max + 1;

// Append the starting index to the URL
$url .= "&start-index=" . $startIndex;

// Get the JSON data from the URL
$json = file_get_contents($url);

// Decode the JSON data into a PHP array
$data = json_decode($json, true);

$totalPosts = $data['feed']['openSearch$totalResults']['$t'];
// Start the sitemap XML
header("Content-Type: application/xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Loop through the array of posts
foreach ($data['feed']['entry'] as $post) {
    // Display the title of each post
    $postId = $post['id']['$t'];
    $postNumber = str_replace("post-", "", strstr($postId, "post-"));
     // Output the post URL as a sitemap URL
     echo '<url>';
     echo '<loc>'.$siteurl.'/blog/'.$blogid.'/post/'. $postNumber . '</loc>';
     echo '</url>';
}
echo '</urlset>';
?>