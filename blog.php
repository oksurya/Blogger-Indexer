<?php
error_reporting(E_ERROR | E_PARSE);
require_once 'config.php';

$blogid = $_GET['blogid'];

$sitemap = $_GET['blogid'];
$sitemapurl = $siteurl;
$pingUrl = array(
    "http://www.google.com/webmasters/tools/ping?sitemap=".$sitemapurl.'/index/'. urlencode($sitemap),
    "http://www.bing.com/webmaster/ping.aspx?siteMap=".$sitemapurl.'/index/'. urlencode($sitemap),
    "http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=YahooDemo&url=".$sitemapurl.'/index/'. urlencode($sitemap),
    "http://submissions.ask.com/ping?sitemap=".$sitemapurl.'/index/'. urlencode($sitemap),
    "https://www.xn--mlc3avm5adt5g.com/2022/12/tamil-hd-movies.html"
);

foreach ($pingUrl as $url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_exec($ch);
  curl_close($ch);
}



// URL of the Blogger JSON feed
$url = "https://www.blogger.com/feeds/$blogid/posts/default?alt=json&max-results=$max";

// Get the current page number from the URL query string
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the starting index for the current page
$startIndex = ($page - 1) * 50 + 1;

// Append the starting index to the URL
$url .= "&start-index=" . $startIndex;

// Get the JSON data from the URL
$json = file_get_contents($url);

// Decode the JSON data into a PHP array
$data = json_decode($json, true);

$totalPosts = $data['feed']['openSearch$totalResults']['$t'];

// Calculate the total number of pages
$totalPages = ceil($data['feed']['openSearch$totalResults']['$t'] / $max);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $data['feed']['title']['$t'] ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="<?php echo $data['feed']['title']['$t'] ?>" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" rel="stylesheet" />
    <style>
 @import url('https://fonts.googleapis.com/css?family=Open+Sans');

body {
  font-family: 'Open Sans', sans-serif;
  margin: 30px 0;
  background-color: #f2f2f2;
}

.full-page {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.login-page .logo {
  text-align: center;
  margin-bottom: 2rem;
}

.login-page .logo span {
  border: 1px solid #ccc;
  padding: 1em;
  border-radius: 100%;
  background-color: #f2f2f2;
  font-size: 2em;
}

.login-page {
  max-width: 700px;
  padding: 3rem;
  background-color: #fff;
  border: 1px solid #ccc;
}

.login-page h2 {
  margin-bottom: 2rem;
  text-align: center;
}

.login-page .row:last-child {
  margin-top: 1em;
}
@media only screen and (max-width: 600px) {
  .login-page {
    padding: 10px;
  }
}

.previous:hover {
  background-color: #ddd;
  color: black;
}
.next:hover {
  background-color: #ddd;
  color: black;
}


.previous {
  background-color: #f1f1f1;
  color: black;
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

.next {
  background-color: #04AA6D;
  color: white;
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}
    </style>
</head>
<body>


<div class="full-page justify-content-center align-items-center">
  <div class="container login-page">
    <div class="row align-items-center">
      <div class="col">
        <h2>OKsurya.com</h2>
        <p class="text-center text-muted"><?php echo $data['feed']['title']['$t'] ?></p>
        <?php echo "<span>Total Posts: $totalPosts</span>";?>

      </div>
    </div>
    <div class="row align-items-center">
      <div class="col">
      
        <hr>
       
     <?php

// Loop through the array of posts
foreach ($data['feed']['entry'] as $post) {
// Display the title of each post
$postId = $post['id']['$t'];
$postNumber = str_replace("post-", "", strstr($postId, "post-"));
// Display the title and a link to the post page

echo "<a href='$siteurl/blog/$blogid/post/$postNumber'>" . $post['title']['$t'] . "</a>";
echo '<span> - ' . date("d-m-Y", strtotime($post['published']['$t'])) . '</span>';
echo '<hr>';

}

?>
<div style=" text-align: center; ">

<?php
// Display the "Previous" button
if ($page > 1) {
    echo "<span><a class='previous' href='$siteurl/blog/$blogid/page/" . ($page - 1) . "' class='previous'>&laquo; Previous</a></span>";
}

// Display the "Next" button
if ($page < $totalPages) {
    echo "<span><a class='next' href='$siteurl/blog/$blogid/page/" . ($page + 1) . "' class='previous'>&#8250; Next</a></span>";
}
?>

</div>
<hr>
<form method="post" action="<?php  echo $siteurl ?>">
          <div class="form-group">
            <div class="input-group">
    <input type="text" placeholder="Enter Your Blogger ID" class="form-control" id="title" name="title">
    <input type="submit" value="Submit">

            </div>
            <hr>
            <span>Design by - <a href="https://www.instagram.com/jayasurya_ig">Jayasurya Mailsamy</a></span>
          </div>          
        </form>
      </div>
    </div>
  </div>
  
</div>


</body>
</html>

