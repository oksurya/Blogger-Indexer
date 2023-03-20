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
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Display the current page of blog posts
for ($i = $offset; $i < $offset + $perPage; $i++) {
    if (!isset($data[$i])) {
        break;
    }
    $post = explode(",", $data[$i]);

    echo '<url>';
    echo '<loc>'.$siteurl.'/blog/'.$post[0].'</loc>';
    echo '</url>';

}
echo '</urlset>';

?>