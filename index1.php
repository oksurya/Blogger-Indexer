<html>
  <head>
    <title>Blogger - Oksurya</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css" integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=" crossorigin="anonymous">
  </head>
  <body>
    <div class="row">
      <div class="small-12 columns">
        <h1>Index your Blogger Blog Faster on Google</h1>
        <?php
        require_once 'config.php';
        if($_SERVER["REQUEST_METHOD"] == "POST") {
          $sitemap = $_POST["sitemap"];
          $sitemapurl = $siteurl;

          $id = uniqid();
          $title = $_POST['sitemap'];
          $newPost = $id . "," . $title."\n";

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

<?php
// Display the current page of blog posts
for ($i = $offset; $i < $offset + $perPage; $i++) {
    if (!isset($data[$i])) {
        break;
    }
    $post = explode(",", $data[$i]);
    echo '<h2>' . $post[0] . '</h2>';
    echo '<hr>';
}
?>
        <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="row">
            <div class="small-12 columns">
              <label>Enter Blogger ID:
                <input type="text" id="sitemap" name="sitemap" size="100">
              </label>
            </div>
          </div>
          <div class="row">
            <div class="small-12 columns">
              <input type="submit" value="Submit" class="button">
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
    </div>
  </body>
</html>
