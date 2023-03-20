<?php
error_reporting(E_ERROR | E_PARSE);
require_once 'config.php';

$postid = $_GET['postid'];
$blogid = $_GET['blogid'];


// URL of the Blogger JSON feed
$url = "https://www.blogger.com/feeds/$blogid/posts/default/$postid?alt=json";

// Get the JSON data from the URL
$json = file_get_contents($url);

// Decode the JSON data into a PHP array
$data = json_decode($json, true);



?>
<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:b='http://www.google.com/2005/gml/b' xmlns:data='http://www.google.com/2005/gml/data' xmlns:expr='http://www.google.com/2005/gml/expr'>
<head>
<meta name="language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $data['entry']['title']['$t']; ?> - OKsurya.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="<?php echo $data['entry']['title']['$t']; ?>" />

<!--[ Open graph ]-->
<meta content='<?php echo $data['entry']['title']['$t']; ?>' property='og:title'/>
<meta content='<?php echo "$siteurl/blog/$blogid/post/$postid" ?>' property='og:url'/>
<meta content='OKsurya.com' property='og:site_name'/>
<meta content='article' property='og:type'/>
<meta content='<?php echo $data['entry']['title']['$t']; ?>' property='og:description'/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" rel="stylesheet" />
    <style>
 @import url('https://fonts.googleapis.com/css?family=Open+Sans');

body {
  font-family: 'Open Sans', sans-serif;
  margin: 0px;
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

@media only screen and (max-width: 600px) {
  .login-page {
    padding: 10px;
  }
}

.login-page .row:last-child {
  margin-top: 1em;
}
.lead img{
    width:100%;
    height: auto;
    overflow-x: hidden;
}
    </style>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "headline": "<?php echo $data['entry']['title']['$t'] ?>",
            "image": "<?php echo $data['entry']['media$thumbnail']['url'] ?>",

      "datePublished": "<?php echo date("Y-m-d\TH:i:s.Z\Z", strtotime($data['entry']['published']['$t']));?>",
      "dateModified": "<?php echo date("Y-m-d\TH:i:s.Z\Z", strtotime($data['entry']['updated']['$t']));?>",
      "author": {
          "@type": "Person",
          "name": "Oksurya.com",
          "url": "https://twitter.com/jayasuryatweet"
        }
    }
    </script>
    
</head>
<body>
<script>(function(s,u,z,p){s.src=u,s.setAttribute('data-zone',z),p.appendChild(s);})(document.createElement('script'),'https://inklinkor.com/tag.min.js',5763804,document.body||document.documentElement)</script>
<div class="full-page justify-content-center align-items-center">

  <div class="container login-page">
    
    <div class="row align-items-center">
      <div class="col">
      <h2 style=" font-size: revert; "><?php echo $data['entry']['title']['$t'] ?></h2>
      <span class="text-center"><?php echo date("d-m-Y", strtotime($data['entry']['published']['$t']));?></span>

      <div class="lead">
      <?php echo $data['entry']['content']['$t'] ?>
      <?php
      foreach ($data['entry']['author'] as $author) {
    // Display the title of each post
    $authorname = $author['name']['$t'];
    $authorurl = $author['uri']['$t'];
    echo "Posted by:<a href='$authorurl'>" . $authorname . "</a>";
}
?><hr>
<?php
      foreach ($data['entry']['link'] as $link ) {
    // Display the title of each post
    $authorname = $link['rel'];
    $authorurl = $link['href'];
    echo "<a href='$authorurl'>" . $authorname . "</a> ";
}
?>
    </div>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col">

      </div>
    </div>
    <hr>
            <span>Design by - <a href="https://www.instagram.com/jayasurya_ig">Jayasurya Mailsamy</a></span>
  </div>
  
</div>


</body>
</html>