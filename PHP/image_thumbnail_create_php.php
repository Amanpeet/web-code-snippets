<?php

if(isset($_REQUEST['submit'])){

	$destpath          = "file/";
	$user_name         =$_REQUEST['user_name'];
	$album_description =$_REQUEST['album_description'];
	$created           =date('Y-m-d H:i:s');

	while(list($key,$value) = each($_FILES["file"]["name"])) {

	if(!empty($value)) {
		if (($_FILES["file"]["type"][$key] == "image/gif")
			|| ($_FILES["file"]["type"][$key] == "image/jpeg")
			|| ($_FILES["file"]["type"][$key] == "image/pjpeg")
			|| ($_FILES["file"]["type"][$key] == "image/png")
			&& ($_FILES["file"]["size"][$key] < 2000000)) {

			$source = $_FILES["file"]["tmp_name"][$key] ;
			$filename = $_FILES["file"]["name"][$key] ;
			$new_pic_id  = uniqid("pic", TRUE);
			$new_pic_id  = str_replace(".","",$new_pic_id);
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			$filename = $new_pic_id . "." . $ext;

			move_uploaded_file($source, $destpath . $filename) ;
			//echo "Uploaded: " . $destpath . $filename . "<br/>" ;
			//thumbnail creation start//
			$tsrc="file/thumbs/".$filename;   // Path where thumb nail image will be stored
			//echo $tsrc;
			/*if (!($_FILES["file"]["type"] =="image/jpeg" OR $_FILES["file"]["type"] =="image/png" OR $_FILES["file"]["type"]=="image/gif")){echo "Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";
			}*/
			$n_width=300;          // Fix the width of the thumb nail images
			$n_height=300;         // Fix the height of the thumb nail imaage

			/////////////////////////////////////////////// Starting of GIF thumb nail creation///////////
			$add=$destpath . $filename; 
			if($_FILES["file"]["type"][$key]=="image/gif"){
				//echo "hello";
				$im=ImageCreateFromGIF($add);
				$width=ImageSx($im);              // Original picture width is stored
				$height=ImageSy($im);                  // Original picture height is stored
				$newimage=imagecreatetruecolor($n_width,$n_height);
				imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
				if (function_exists("imagegif")) {
					Header("Content-type: image/gif");
					ImageGIF($newimage,$tsrc);
				}
				if (function_exists("imagejpeg")) {
					Header("Content-type: image/jpeg");
					ImageJPEG($newimage,$tsrc);
				}
			}
			//chmod("$tsrc",0777);
			////////// end of gif file thumb nail creation//////////
			$n_width=300;          // Fix the width of the thumb nail images
			$n_height=300;         // Fix the height of the thumb nail imaage

			////////////// starting of JPG thumb nail creation//////////
			if($_FILES["file"]["type"][$key]=="image/jpeg"){
				echo $_FILES["file"]["name"][$key]."<br>";
				$im=ImageCreateFromJPEG($add); 
				$width=ImageSx($im);              // Original picture width is stored
				$height=ImageSy($im);             // Original picture height is stored
				$newimage=imagecreatetruecolor($n_width,$n_height);                 
				imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
				ImageJpeg($newimage,$tsrc);
				chmod("$tsrc",0777);
			}
		////////////////  End of png thumb nail creation //////////
		if($_FILES["file"]["type"][$key]=="image/png"){
			//echo "hello";
			$im=ImageCreateFromPNG($add);
			$width=ImageSx($im);              // Original picture width is stored
			$height=ImageSy($im);                  // Original picture height is stored
			$newimage=imagecreatetruecolor($n_width,$n_height);
			imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
			if (function_exists("imagepng")) {
				//Header("Content-type: image/png");
				ImagePNG($newimage,$tsrc);
			}
			if (function_exists("imagejpeg")) {
				//Header("Content-type: image/jpeg");
				ImageJPEG($newimage,$tsrc);
			}
		}

		// thumbnail creation end---
		} 	else{
			echo "error in upload";
		}
	}
	$query="INSERT INTO `upload_files`(`file_id`, `user_id`, `user_name`, `file_name`, `album_description`, `status`, `created`) VALUES ('DEFAULT ',$user_id,'$user_name','$filename','$album_description','0','$created')";
	mysqli_query($conn,$query) or die(mysql_error($conn));
	}
	echo "Files has been uploaded";
}

?> 
