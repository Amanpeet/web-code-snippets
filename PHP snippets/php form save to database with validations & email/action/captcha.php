<?php
// Start the session to store the captcha code
session_start();

// Generate a random captcha code
$captcha = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

// Store the captcha code in the session
$_SESSION['captcha'] = $captcha;

// Set the content type header
header('Content-Type: image/png');

// Create an image with specified dimensions
$image = imagecreatetruecolor(120, 40);

// Set background color to white
$bg_color = imagecolorallocate($image, 255, 255, 255);

// Fill the image with the background color
imagefilledrectangle($image, 0, 0, 120, 40, $bg_color);

// Set the font color to black
$text_color = imagecolorallocate($image, 0, 0, 0);

// Draw the captcha text on the image
imagestring($image, 5, 20, 10, $captcha, $text_color);

// Output the image as PNG
imagepng($image);

// Clean up resources
imagedestroy($image);
