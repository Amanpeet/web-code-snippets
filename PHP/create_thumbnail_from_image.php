<?php
//https://stackoverflow.com/questions/11376315/creating-a-thumbnail-from-an-uploaded-image

function make_thumb($src, $dest, $desired_width) {

  // get source file extension
  $src_name = explode(".", $src );
  $src_ext = end($src_name);
  $src_mime = mime_content_type($src_name); //use this if ext doesnt work

  /* read the source image */
  // $source_image = imagecreatefromjpeg($src);
  switch ($src_ext) {
    case 'jpg' || 'JPG' || 'jpeg' || 'JPEG' || 'image/jpeg':
      $source_image = imagecreatefromjpeg($src);
      break;
    case 'png' || 'PNG' || 'image/png':
      $source_image = imagecreatefrompng($src);
      break;
    default:
      $source_image = imagecreatefromjpeg($src);
  }

  $width = imagesx($source_image);
  $height = imagesy($source_image);

  /* find the "desired height" of this thumbnail, relative to the desired width  */
  $desired_height = floor($height * ($desired_width / $width));

  /* create a new, "virtual" image */
  $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

  /* copy source image at a resized size */
  imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

  /* create the physical thumbnail image to its destination */
  // $thethumb = imagejpeg($virtual_image, $dest);
  switch ($src_ext) {
    case 'jpg' || 'jpeg' || 'JPG' || 'JPEG':
      $thethumb = imagejpeg($virtual_image, $dest);
      break;
    case 'png' || 'PNG':
      $thethumb = imagepng($virtual_image, $dest);
      break;
    default:
      $thethumb = imagejpeg($virtual_image, $dest);
  }

  if( $thethumb ){
    return true;
  } else {
    return false;
  }
}

$theout = "../uploads/index_thumb.jpg";
$desired_width="240";
make_thumb($thefile, $theout, $desired_width);