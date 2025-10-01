<?php include('header.php'); ?>
<script>
  $(function () {
    $('.words-loader').addClass('flashOut');
    $('.words-loader').fadeOut(500);
  });
</script>

<!-- Section -->
<div class="page-section py-5">
  <div class="container pt-5 mt-5">
    <h4 class="font-writing big-h1 text-color"> Projects </h4>
    <h6><em class="text-color"><?php if(isset($_REQUEST['view'])){ echo $_REQUEST['view']; } ?></em></h6>
  </div>
</div>

<!-- Section -->
<div class="page-section">
  <div class="container">
    <div class="projects-filter">

      <ul class="filters-group filters-active list-unstyled text-left mb-4">
        <li class="d-inline-block button"> <a href="projects.php"> All </a> </li>
        <li class="d-inline-block button"> <a href="projects.php?view=2. RESIDENTIAL"> Residential</a> </li>
        <li class="d-inline-block button"> <a href="projects.php?view=1. RETAIL"> Retail </a> </li>
        <li class="d-inline-block button"> <a href="projects.php?view=3. CORPORATE"> Corporate </a> </li>
        <li class="d-inline-block button"> <a href="projects.php?view=4. FURNITURE DESIGN"> Furniture Design </a> </li>
        <li class="d-inline-block button"> <a href="projects.php?view=5. BRANDING COMMUNICATION"> Branding & Communication </a> </li>
        <li class="d-inline-block button"> <a href="projects.php?view=6. EXTRA"> Extra </a> </li>
      </ul>

      <?php
      /* RETURN THUMBNAIL FOR FOLDERS */
      function displayFolders($fol_dir){
        // $gal_dir  = '/img/projects/project1/'; //get folder as parameter
        $dir = $_SERVER['DOCUMENT_ROOT'].$fol_dir; //gallery folder
        $site_url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']); //get site url
        $ImagesArray = [];
        $file_display = [ 'jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG' ];
        if(file_exists($dir) == false) {
          echo  "Directory $dir not found!";
          return;
        }
        $img_url = "";
        $thumb = "thumb.jpg";
        if(file_exists($dir."/".$thumb) == true){
          //thumbnail found
          $img_url = $site_url . $fol_dir ."/". $thumb;
        } else {
          $dir_contents = scandir($dir);
          foreach ($dir_contents as $file) {
            $file_type = pathinfo($file, PATHINFO_EXTENSION);
            if (in_array($file_type, $file_display) == true) {
              $ImagesArray[] = $file;
            }
          }
          $img_url = $site_url . $fol_dir ."/". $ImagesArray[0];
        }
        return $img_url;
      }

      /* DISPLAY ALL IMAGES FROM A FOLDER */
      function displayImages($gal_dir){
        // $gal_dir  = '/img/projects/project1/'; //get folder as parameter
        $dir = $_SERVER['DOCUMENT_ROOT'].$gal_dir; //gallery folder
        $site_url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']); //get site url
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
          // DISPLAY ALL IMAGES
          foreach ( $ImagesArray as $image ) {
            $img_url = $site_url . $gal_dir ."/". $image;
            if( $image != "thumb.jpg" ){ //ignore thumb
              ?>
              <div class="col-sm-6 col-md-4 mb-4">
                <a class="gallery-link minixxx" data-fancybox="gallery" href="<?php echo $img_url; ?>">
                  <img class="img-thumbnail" src="<?php echo $img_url; ?>" alt="">
                </a>
              </div>
              <?php
            }
          }
        }
      }
      ?>
      <!-- for folders -->
      <div class="row gallery-row">
        <?php
        // IF INNER FOLDER SET
        $inner_dir = "";
        if( isset($_REQUEST['view']) && $_REQUEST['view'] !='' ){
          $view = $_REQUEST['view'];
          $inner_dir = "/".$view;
        } else {
          $inner_dir = "";
        }

        /* LIST ALL FOLDERS */
        $dir_only = '/img/projects'.$inner_dir;
        $base_dir = $_SERVER['DOCUMENT_ROOT'] . $dir_only ; //projects folder
        $directories = glob($base_dir . '/*' , GLOB_ONLYDIR);
        foreach ($directories as $folder) {
          // $folder."<br>";
          $folder_name = explode('/', $folder);
          $folder_name = end($folder_name);

          $thumb_url = displayFolders($dir_only."/".$folder_name);

          $folder_parts = explode('_', $folder_name);
          $folder_title = ltrim($folder_parts[0], '1234567890.');
          $folder_place = $folder_parts[1];
          $folder_area = $folder_parts[2];
          ?>
          <div class="col-md-4 col-sm-6">
            <a class="gallery-link" href='projects.php?view=<?php echo $inner_dir."/".$folder_name; ?>'>
              <img src="<?php echo $thumb_url; ?>" alt="">
              <div class="gallery-text">
                <h4><?php echo $folder_title; ?></h4>
                <h6 class="font-light"><?php echo $folder_place; ?></h6>
                <h6 class="font-light"><?php echo $folder_area; ?></h6>
              </div>
            </a>
          </div>
          <?php
        }
        ?>
      </div>

      <!-- for images -->
      <div class="row">
        <?php
        // LIST ALL FILES
        $files = array_filter(glob($base_dir ."/*"), 'is_file');
        // var_dump($files);
        if( !empty($files) ){
          // echo $base_dir;
          // echo $dir_only;
          displayImages($dir_only);
        }
        ?>
      </div>

    </div>
  </div>
</div>

<?php include('footer.php'); ?>
