<?php
session_start();
if(isset($_SESSION['username']) && isset($_GET['img']) ) {
  $filename = $_GET['img'];
  $filepath = "../uploads/".$filename;
  if( file_exists($filepath) ){
    $type = 'image/jpeg';
    header('Content-Type:'.$type); //no content before headers
    header('Content-Length: ' . filesize($filepath));
    readfile($filepath);
  } else {
    echo "img not found";
  }
} else {
  echo "img access denied";
}
/*
.HTACCESS
order deny,allow
deny from all
*/