<form action="" method="post" enctype="multipart/form-data">
  <input type="file" id="fileselect" name="fileselect[]" multiple="multiple" accept="image/*" />
  <input type="submit" value="Upload!" />
</form>



<?php

//uploding file to server
$valid_formats = array("jpg", "jpeg", "png", "gif", "bmp");
$max_file_size = 1024 * 2000; //2000 kb
// $path = site_url()."/imageUploads/"; // Upload directory
echo $path = realpath('./') . '/imageUploads/';
$count     = 0;

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
  // Loop $_FILES to exeicute all files
  foreach ($_FILES['fileselect']['name'] as $f => $name) {
    if ($_FILES['fileselect']['error'][$f] == 4) {
      continue; // Skip file if any error found
    }
    if ($_FILES['fileselect']['error'][$f] == 0) {
      if ($_FILES['fileselect']['size'][$f] > $max_file_size) {
        $message[] = "$name is too large!.";
        continue; // Skip large files
      } elseif (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats)) {
        $message[] = "$name is not a valid format";
        continue; // Skip invalid file formats
      } else {
        // No error found! Move uploaded files
        if (move_uploaded_file($_FILES["fileselect"]["tmp_name"][$f], $path . $name)) {
          $count++;// Number of successfully uploaded file
        }
      }
    }
  }
  //Displaying messages
  foreach ($message as $key => $value) {
  	echo "<br>" . $value . "<br>";
  }
  if($count=0){
		echo "<h2>ERROR in FiLES UPLOAD!</h2>";
  } else {
  	echo "<h2>$count FiLES UPLOADED!</h2>";
  }
}

?>