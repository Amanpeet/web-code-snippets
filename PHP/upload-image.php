<?php
  //direct image
  if ( isset($_FILES["quote_img"]) ) {
    //Generate base64 image
    $get_image = file_get_contents($_FILES["quote_img"]["tmp_name"]);
    $base64_img = base64_encode($get_image);
  }

  // upload file
  if ( isset($_FILES["quote_img"]) ) {
    $imgOK = 1;

    $filepath = $_FILES['quote_img']['tmp_name'];
    $fileSize = filesize($filepath);
    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
    $filetype = finfo_file($fileinfo, $filepath);

    if ($fileSize === 0) {
      echo "Image is corrupted. Please try again.";
      $imgOK = 0;
    }

    if ($fileSize > (1 * 1024 * 1024) ) { // 2 MB
      echo "Image is too large. Max size allowed is 1 MB.";
      $imgOK = 0;
    }

    $allowedTypes = [ 'image/png' => 'png', 'image/jpeg' => 'jpg' ];
    if (!in_array($filetype, array_keys($allowedTypes))) {
      echo "Only JPG, JPEG & PNG images are allowed.";
      $imgOK = 0;
    }

    // Check if all Ok
    if ($imgOK == 1) {

      // set upload params
      $filename = basename($filepath);
      $extension = $allowedTypes[$filetype];
      $targetDirectory = __DIR__ . "/uploads";
      $newFilepath = $targetDirectory . "/" . $filename . "." . $extension;

      // Move the file, returns false if failed
      if ( move_uploaded_file($filepath, $newFilepath) ) {
        echo "The file is uploaded successfully!";
      } else {
        echo "Sorry, there was an error uploading file.";
      }

    }
  }
?>

<img src="data:image/png;base64, <?php echo $base64_img; ?>">
<img src="<?php echo $newFilepath; ?>" alt="" width="400">

<form id="quoteForm" method="POST" action="" enctype="multipart/form-data">
  Upload Image: <input type="file" name="quote_img">
  <button type="submit" name="quote_submit" value="quote_submit"> SUBMIT </button>
</form>