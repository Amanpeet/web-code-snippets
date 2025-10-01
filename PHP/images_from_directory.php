<?php
  /*
  * GET IMAGES FROM DIRECTORY
  * Author: Amanz
  */

  //get site url for image
  $site_url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);

  //get files list
  $dir = $_SERVER['DOCUMENT_ROOT'].'/img/gallery/';

  //get this script path and traverse from there
  list($scriptPath) = get_included_files();
  $dir = dirname($scriptPath);

  // directory scan
  $files = glob($dir."/img/gallery/*.*");

  //display files
  foreach ( $files as $image_path ) {
    $image = basename($image_path);
    ?>
    <div class="col-lg-3 col-md-4">
      <div class="card">
        <a href="<?php echo $site_url .'/img/gallery/'. $image; ?>" data-fancybox="gallery">
          <img class="card-img-top" src="<?php echo $site_url .'/img/gallery/'. $image; ?>" alt="img">
        </a>
      </div>
    </div>
    <?php
  }

?>