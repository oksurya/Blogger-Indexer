<?php
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";  
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'];  
// Database connection settings


// Site SETTINGS
define('SITE_TITLE', 'Blogger Indexer');
define('HOME_TITLE', '');

define('SITE_DESCRIPTION', '');

define('SITE_URL', '');
define('PROXY1', '');



$siteurl =  $CurPageURL;

$max = 150;

// Connect to the database


?>
