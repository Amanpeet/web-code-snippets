<?php
  /*
   DISPLAY ALL IMAGES FROM A FOLDER
  */

  //get site url 
  $site_url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']); 

  //gallery folder
  $dir = $_SERVER['DOCUMENT_ROOT'].'/img/gallery/';

  $ImagesArray = [];
  $file_display = [ 'jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG' ];

  if (file_exists($dir) == false) {
    echo  "Directory $dir not found!";
  } else {

    $dir_contents = scandir($dir);
    foreach ($dir_contents as $file) {
      $file_type = pathinfo($file, PATHINFO_EXTENSION);
      if (in_array($file_type, $file_display) == true) {
        $ImagesArray[] = $file;
      }
    }

    print_r($ImagesArray);

    // DISPLAY ALL IMAGES
    foreach ( $ImagesArray as $image ) {
      ?>
      <div class="col-lg-2 col-md-4">
        <div class="card">
          <a href="<?php echo $site_url .'img/gallery/'. $image; ?>" data-fancybox="gallery">
            <img class="card-img-top" src="<?php echo $site_url .'img/gallery/'. $image; ?>" alt="">
          </a>
        </div>
      </div>
      <?php
    }

    // DISPLAY RANDOM 6 IMAGES
    for($i = 0; $i < 6; $i++) {
      $randy = array_rand($ImagesArray);
      $image = $ImagesArray[$randy];
      ?>
      <div class="col-lg-4 col-md-6">
        <div class="card">
          <a href="<?php echo $site_url .'img/gallery/'. $image; ?>" data-fancybox="gallery">
            <img class="card-img-top" src="<?php echo $site_url .'img/gallery/'. $image; ?>" alt="">
          </a>
        </div>
      </div>
      <?php
    }

  }

?>