<?php

require_once 'config.php';



// Number of posts per page
$perPage = 20;

// Current page number
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Blog post data stored in a flat file
$data = file('blog-data.txt');
rsort($data);

// Total number of posts
$total = count($data);

// Total number of pages
$pages = ceil($total / $perPage);

// Offset for the current page
$offset = ($page - 1) * $perPage;
header("Content-Type: application/xml; charset=UTF-8");
echo '<rss version="2.0">';
echo '<channel>
  <title>OKSurya</title>
  <link>'.$siteurl.'</link>
  <description>Blogger Feeds</description>';
// Display the current page of blog posts
for ($i = $offset; $i < $offset + $perPage; $i++) {
    if (!isset($data[$i])) {
        break;
    }
    $post = explode(",", $data[$i]);
  echo '<item>
    <title><![CDATA['.$post['0'].']]></title>
    <link>'.$siteurl.'/blog/'.$post[0].'</link>
    <description><![CDATA[This post is first appeard in OKSurya.com - '.$post['0'].']]></description>
  </item>';
}
  echo '</channel></rss>';

?>