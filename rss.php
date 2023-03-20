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
echo '<rss version="2.0">';
echo '<channel>
  <title>OKSurya</title>
  <link>'.$siteurl.'</link>
  <description>Blogger Feeds</description>';

  foreach ($data['feed']['entry'] as $post) {
    // Display the title of each post
    $postId = $post['id']['$t'];
    $postNumber = str_replace("post-", "", strstr($postId, "post-"));
  echo '<item>
    <title><![CDATA['.$post['title']['$t'].']]></title>
    <link>'.$siteurl.'/blog/'.$blogid.'/post/'. $postNumber . '</link>
    <description><![CDATA[This post is first appeard in OKSurya.com - '.$post['title']['$t'].']]></description>
  </item>';
}

  echo '</channel></rss>';
?>