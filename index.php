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



// Add a new blog post
if (isset($_POST['title'])) {
    $id = uniqid();
    $title = $_POST['title'];
    $sitemap = $_POST["title"];
    $sitemapurl = $siteurl;
    $newPost = $title . "\n";
    file_put_contents('blog-data.txt', $newPost, FILE_APPEND);




    $pingUrl = array(
        "http://www.google.com/webmasters/tools/ping?sitemap=".$sitemapurl.'/index/'. urlencode($sitemap),
        "http://www.bing.com/webmaster/ping.aspx?siteMap=".$sitemapurl.'/index/'. urlencode($sitemap),
        "http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=YahooDemo&url=".$sitemapurl.'/index/'. urlencode($sitemap),
        "http://submissions.ask.com/ping?sitemap=" .$sitemapurl.'/index/'. urlencode($sitemap)
      );

      foreach ($pingUrl as $url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
        curl_close($ch);
      }

header("Location:$sitemapurl/blog/$sitemap");
exit;
    } else {
?>
<html>
  <head>
      <meta name="google-site-verification" content="IFAsRYvhjeGWvmnH6fuJWa6MRgOdhdy4p-Elj-FrADM" />
    <title>Blogger Indexer - Oksurya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="monetag" content="d526452d119cd374b0c002af9db1a50f">
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
@media only screen and (max-width: 600px) {
  .login-page {
    padding: 10px;
  }
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
    </style>
      </head>
  <body>

  <div class="full-page justify-content-center align-items-center">
  <div class="container login-page">
    <div class="row align-items-center">
      <div class="col">
        <h2>@oksurya</h2>
        <p class="text-center text-muted">Blogger Indexer</p>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col">
      <form method="post">
          <div class="form-group">
            <div class="input-group">
    <input type="text" placeholder="Enter Your Blogger ID" class="form-control" id="title" name="title">
    <input type="submit" value="Submit">

            </div>
          </div>          
        </form>
        <hr>
        <?php
        // Display the current page of blog posts
for ($i = $offset; $i < $offset + $perPage; $i++) {
    if (!isset($data[$i])) {
        break;
    }
    $post = explode(",", $data[$i]);
    echo '<a href="blog/' . $post[0] . '">' . $post[0] . '</a>';
    echo '<hr>';
} 

// Display the pagination links
for ($i = 1; $i <= $pages; $i++) {
    if ($i == $page) {
        echo "<strong>$i</strong> ";
    } else {
        echo "<a href='?page=$i'>$i</a> ";
    }
}
?>
      </div>
    </div>
  </div>
</div>

 

<?php
        }
        ?>
     
  </body>
</html>
