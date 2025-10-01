<?php 

//if SSL
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}

$site_url = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']); 



//otherwise
$site_url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']); 

echo $site_url;

?>