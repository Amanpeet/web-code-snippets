<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


echo $image_path = "../uploads/test.png";
create_cropped_thumbnail($image_path, 400, 400, 'thumb');

function create_cropped_thumbnail($image_path, $thumb_width, $thumb_height, $prefix) {

  if (!(is_integer($thumb_width) && $thumb_width > 0) && !($thumb_width === "*")) {
    echo "The width is invalid";
    exit(1);
  }

  if (!(is_integer($thumb_height) && $thumb_height > 0) && !($thumb_height === "*")) {
    echo "The height is invalid";
    exit(1);
  }

  $extension = pathinfo($image_path, PATHINFO_EXTENSION);
  $filename  = pathinfo($image_path, PATHINFO_FILENAME);
  $dirname   = pathinfo($image_path, PATHINFO_DIRNAME);
  $finalpath = $dirname ."/". $filename . "_" . $prefix . ".". $extension;

  switch ($extension) {
    case "jpg":
    case "jpeg":
      $source_image = imagecreatefromjpeg($image_path);
      break;
    case "gif":
      $source_image = imagecreatefromgif($image_path);
      break;
    case "png":
      $source_image = imagecreatefrompng($image_path);
      break;
    default:
      exit(1);
      break;
  }

  $source_width = imageSX($source_image);
  $source_height = imageSY($source_image);

  if (($source_width / $source_height) == ($thumb_width / $thumb_height)) {
    $source_x = 0;
    $source_y = 0;
  }

  if (($source_width / $source_height) > ($thumb_width / $thumb_height)) {
    $source_y = 0;
    $temp_width = $source_height * $thumb_width / $thumb_height;
    $source_x = ($source_width - $temp_width) / 2;
    $source_width = $temp_width;
  }

  if (($source_width / $source_height) < ($thumb_width / $thumb_height)) {
    $source_x = 0;
    $source_y = 0;
    // $source_y = ($source_height - $temp_height) / 2;
    $temp_height = $source_width * $thumb_height / $thumb_width;
    $source_height = $temp_height;
  }

  $target_image = ImageCreateTrueColor($thumb_width, $thumb_height);
  imagecopyresampled($target_image, $source_image, 0, 0, $source_x, $source_y, $thumb_width, $thumb_height, $source_width, $source_height);

  switch ($extension) {
    case "jpg":
    case "jpeg":
      imagejpeg($target_image, $finalpath);
      break;
    case "gif":
      imagegif($target_image, $finalpath);
      break;
    case "png":
      imagepng($target_image, $finalpath);
      break;
    default:
      exit(1);
      break;
  }

  imagedestroy($target_image);
  imagedestroy($source_image);
}
