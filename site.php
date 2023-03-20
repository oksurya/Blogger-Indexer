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

// Calculate the total number of pages
$totalPages = ceil($data['feed']['openSearch$totalResults']['$t'] / $max);


// Start the sitemap XML
header("Content-Type: application/xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';


for ($i = 1; $i <= $totalPages; $i++) {
    if ($i == $page) {
        echo '<sitemap>';
    echo "<loc>$siteurl/sitemap/$blogid/page/" . $i . "</loc>";
    echo '</sitemap>';
    } else {
    echo '<sitemap>';
    echo "<loc>$siteurl/sitemap/$blogid/page/" . $i . "</loc>";
    echo '</sitemap>';
    }
}

// End the sitemap XML
echo '</sitemapindex>';



?>
