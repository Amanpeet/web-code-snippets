<?php
// session_start();
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$code=rand(1000,9999);
$_SESSION["code"]=$code;
$im = imagecreatetruecolor(80, 25);
$bg = imagecolorallocate($im, 0, 56, 117); //background color blue
$fg = imagecolorallocate($im, 255, 255, 255);//text color white
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 20, 5,  $code, $fg);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);