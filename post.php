<?php
error_reporting(E_ERROR | E_PARSE);
$postNumber = $_GET['id'];

// URL of the Blogger JSON feed
$url = "https://www.blogger.com/feeds/7206898359549507493/posts/default/$postNumber?alt=json";

// Get the JSON data from the URL
$json = file_get_contents($url);

// Decode the JSON data into a PHP array
$data = json_decode($json, true);

// Get the post number from the query string


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $data['entry']['title']['$t']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="<?php echo $data['feed']['subtitle']['$t'] ?>" />
<style>
    body {padding: 0; margin:0 auto; max-width: 730px; font-family: 'Inter', 'Noto Sans Tamil', sans-serif; background: #f9f9f9; font-size: 14px;}

</style>
</head>
<body>
    <script>(function(s,u,z,p){s.src=u,s.setAttribute('data-zone',z),p.appendChild(s);})(document.createElement('script'),'https://inklinkor.com/tag.min.js',5763804,document.body||document.documentElement)</script>
<?php echo $data['entry']['content']['$t'];?>
</body>
</html>