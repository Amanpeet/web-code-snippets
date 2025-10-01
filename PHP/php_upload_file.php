<?php 
  /* 
  	THE UPLOADED PROFILE PIC
  	dont forget the upload path
  */
  function upload_profile_pic() {

	  // if($_FILES["pic_input"]["error"] > 0){
	  //     echo "Error: " . $_FILES["pic_input"]["error"] . "<br>";
	  // } else {
	  //     echo "File Name: " . $_FILES["pic_input"]["name"] . "<br>";
	  //     echo "File Type: " . $_FILES["pic_input"]["type"] . "<br>";
	  //     echo "File Size: " . round($_FILES["pic_input"]["size"] / 1024) . " KB<br>";
	  //     echo "Stored in: " . $_FILES["pic_input"]["tmp_name"];
	  // }

	  if(isset($_FILES["pic_input"]["error"])){

	      if($_FILES["pic_input"]["error"] > 0){
	          echo "Error: " . $_FILES["pic_input"]["error"] . "<br>";
	      } else{
	          $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	          $filename = $_FILES["pic_input"]["name"];
	          $filetype = $_FILES["pic_input"]["type"];
	          $filesize = $_FILES["pic_input"]["size"];

						$filesize_kb = round($_FILES["pic_input"]["size"] / 1024);
						$upload_path = $_SERVER['DOCUMENT_ROOT'] . '/getreal/uploads/profile_pics/';
						$new_pic_id  = uniqid("pic", TRUE);
						$new_pic_id  = str_replace(".","",$new_pic_id);
	      
	          // Verify file extension
	          $ext = pathinfo($filename, PATHINFO_EXTENSION);
	          if(!array_key_exists($ext, $allowed)){
	          	die("Error: Please select a valid file format.");      
	          } 

	          // Verify file size - 5MB maximum
	          $maxsize = 5 * 1024 * 1024;
	          if($filesize > $maxsize){
	          	die("Error: File size is larger than the allowed limit.");
	          } 
	      
	          // Verify MYME type of the file
	          if(in_array($filetype, $allowed)){
	              // MOVE the uploaded file to directory
	              // move_uploaded_file($_FILES["pic_input"]["tmp_name"], "uploads/" . $_FILES["pic_input"]["name"]);

	          		$profile_pic_name = $new_pic_id . "." . $ext;
	          		$profile_pic_url  = site_url() . "/uploads/profile_pics/" . $profile_pic_name;
	              
	              if( move_uploaded_file( $_FILES["pic_input"]["tmp_name"], $upload_path ."/". $profile_pic_name ) ){
	              	echo "Your file was uploaded successfully.";

		              /*  INSERT IMAGE NAME IN DATABASE  */
		              // require_once('../../../wp-config.php');
		              global $wpdb;
		              $table_name = "profile_pics";
		              //$wpdb->insert( $table_name, array( 'user_id' => 'guest_new', 'picture_name' => $profile_pic_name, 'picture_url' => $profile_pic_url ) );
		              $sql = "INSERT INTO profile_pics( user_id, picture_name, picture_url ) VALUES ( 'guest_new', '$profile_pic_name', '$profile_pic_url' )";
		              echo $result = ( $wpdb->query($sql) ) ? "DONE DONE" : "FATAL ERROR" ;
	              	
	              } else {
	              	echo "Your file encountered some error.";
	              }

	          } else {
	              echo "Error: There was a problem uploading your file - please try again."; 
	          }
	      }
	  } else{
	      echo "Error: Invalid parameters - please contact your server administrator.";
	  }

}//upload_profile_pic end


?>