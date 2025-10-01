<?php
$con = mysqli_connect("localhost","local854_local","local123","local854_local");
// error_reporting(0);

//Get Variables
$initilize_action = $_POST['initilize_action'];
if( empty($initilize_action) ){
  die("Function Initilizer not Set!");
} else if ( $initilize_action == 'new_ticket' ){
  insertTicket();
} else if ( $initilize_action == 'update_ticket' ){
  updateTicket();
} else if ( $initilize_action == 'delete_ticket' ){
  deleteTicket();
} else if ( $initilize_action == 'load_tickets' ){
  loadTickets();
}


function insertTicket(){

  global $con;
  $newfilename = '';

  $tic_title       = $_POST['tic_title'];
  $tic_description = $_POST['tic_description'];
  $tic_status      = $_POST['tic_status'];
  $tic_datepicker  = $_POST['tic_datepicker'];
  $tic_url         = $_POST['tic_url'];

  // $tic_file        = $_FILES['tic_file'];
  // var_dump($_FILES);


  //if empty values
  if( empty($tic_title) || empty($tic_description) || empty($tic_status) || empty($tic_datepicker)  || empty($tic_url) ){
    echo "Please input all values to proceed!";
  } else {

    if (isset($_FILES["tic_file"]["type"])) {
      $validextensions = array("jpeg", "jpg", "png");
      $temporary = explode(".", $_FILES["tic_file"]["name"]);
      $file_extension = end($temporary);
      // $size_limit = 1024 * 10000 ;
      $size_limit = 1024 * 1024 ;

      //Approx. 100kb files can be uploaded.
      if ( ($_FILES["tic_file"]["size"] < $size_limit ) && in_array($file_extension, $validextensions)) {
        if ($_FILES["tic_file"]["error"] > 0) {
          echo "Return Code: ".$_FILES["tic_file"]["error"]. "<br/><br/>";
        } else {
          // Storing source path of the file in a variable
          $sourcePath = $_FILES['tic_file']['tmp_name']; 

          // Target path where file is to be stored
          // $file_unq_name = uniqid('tic_') ;
          $newfilename = 'tic_' . round(microtime(true)) . '.' . $file_extension;
          $targetPath = "../uploads/".$newfilename; 

          // Moving Uploaded file
          move_uploaded_file($sourcePath, $targetPath); 
          echo "File Uploaded successfully! ";

          // echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
          // echo "<br/><b>File Name:</b> ".$_FILES["file"]["name"]. "<br>";
          // echo "<b>Type:</b> ".$_FILES["tic_file"]["type"]. "<br>";
          // echo "<b>Size:</b> ".($_FILES["tic_file"]["size"] / 1024). " kB<br>";
          // echo "<b>Temp file:</b> ".$_FILES["tic_file"]["tmp_name"]. "<br>";
        }
      } else {
        echo "FILE UPLOAD ERROR: Invalid file Size or Type! ";
      }
    }

    // //get the unique_order_id
    // $queryt = "SELECT unique_order_id FROM order_recipient_information where id='$reci_id' ";
    // $unique_order_id_exist = mysqli_query($con, $queryt);
    // if(mysqli_num_rows($unique_order_id_exist) > 0) {
    //   $unique_order_id_data = mysqli_fetch_array($unique_order_id_exist, MYSQLI_ASSOC);
    // } else {
    //   die("Unique order id not found!");
    // }
    // $get_unique_order_id = (!empty($unique_order_id_data{'unique_order_id'})) ? $unique_order_id_data{'unique_order_id'} : "";

    // Insert into db
    if( !empty($tic_title) && !empty($tic_description)  && !empty($tic_status) ) {

      $queryx = "INSERT INTO customer_service_ticket( title, description, status, image, dated, url ) VALUES ( '$tic_title',  '$tic_description', '$tic_status', '$newfilename', '$tic_datepicker', '$tic_url' ) ";

      $resultx = mysqli_query($con, $queryx);
      if( $resultx ){
        echo "SUCCESS: All values inserted successfully.";
      } else {
        echo "ERROR: Fatal Error in inserting values!";
      }
    }

  }
} // function insertTicket end


function updateTicket(){

  global $con;
  $newfilename = '';

  $ticket_id       = $_POST['ticket_id'];
  $tic_title       = $_POST['tic_upd_title'];
  $tic_description = $_POST['tic_upd_description'];
  $tic_status      = $_POST['tic_upd_status'];
  $tic_datepicker  = $_POST['tic_upd_datepicker'];
  $tic_url         = $_POST['tic_upd_url'];
  $imagecheck 		 = 1;

  // $tic_file        = $_FILES['tic_file'];
  // var_dump($_FILES);

  //if empty values
  if( empty($ticket_id) ){
  	echo "Valid ticket id not found!";
  } 
  else if( empty($tic_title) || empty($tic_description) || empty($tic_status) || empty($tic_datepicker)  || empty($tic_url) ){
    echo "Please input all values to proceed!";
  } 
  else {

    if (isset($_FILES["tic_upd_image"]["type"])) {
      $validextensions = array("jpeg", "jpg", "png");
      $temporary = explode(".", $_FILES["tic_upd_image"]["name"]);
      $file_extension = end($temporary);
      $size_limit = 1024 * 1024 ; //1mb

      //Approx. 100kb files can be uploaded.
      if ( ($_FILES["tic_upd_image"]["size"] < $size_limit ) && in_array($file_extension, $validextensions)) {
        if ($_FILES["tic_upd_image"]["error"] > 0) {
          echo "Return Code: ".$_FILES["tic_upd_image"]["error"]. "<br/><br/>";
        } else {
          // Storing source path of the file in a variable
          $sourcePath = $_FILES['tic_upd_image']['tmp_name']; 

          // Target path where file is to be stored
          $newfilename = 'tic_' . round(microtime(true)) . '.' . $file_extension;
          $targetPath = "../uploads/".$newfilename; 

          // Moving Uploaded file
          move_uploaded_file($sourcePath, $targetPath); 
          echo "File Uploaded successfully! ";
        }
      } else {
        echo "FILE UPLOAD ERROR: Invalid file Size or Type! ";
      }
    } else {
    	// echo "Valid image file not found!";
    	$imagecheck = 0;
    }

    // Insert into db after second check
    if( !empty($tic_title) && !empty($tic_description)  && !empty($tic_status) ) {

    	if( $imagecheck == 0 ){
      	$queryx = "UPDATE customer_service_ticket SET title='$tic_title', description='$tic_description', status='$tic_status', dated='$tic_datepicker', url='$tic_url' WHERE  id = '$ticket_id' ";
    	} else {
      	$queryx = "UPDATE customer_service_ticket SET title='$tic_title', description='$tic_description', status='$tic_status', image='$newfilename', dated='$tic_datepicker', url='$tic_url' WHERE  id = '$ticket_id' ";
    	}

      $resultx = mysqli_query($con, $queryx);
      if( $resultx ){
        echo "SUCCESS: Ticket updated successfully.";
      } else {
        echo "ERROR: Fatal Error in updating ticket!";
      }
    }

  }
} // function updateTicket end


function deleteTicket(){
  global $con;
  $ticket_id  = $_POST['ticket_id'];

  $queryx = "DELETE FROM customer_service_ticket WHERE id = '$ticket_id' ";

  $resultx = mysqli_query($con, $queryx);
  if( $resultx ){
    echo "SUCCESS: Ticket Deleted successfully.";
  } else {
    echo "ERROR: Ticket Deletion failed! Reload page and try again.";
  }
} // function deleteTicket end


function loadTickets(){
  global $con;

  // //get the unique_order_id
  $queryt = "SELECT * FROM customer_service_ticket";
  $execute_query = mysqli_query($con, $queryt) or die(mysqli_error('second error '.$con));
  $count = 1;

  if(mysqli_num_rows($execute_query) > 0) {
    while($resultset = mysqli_fetch_array($execute_query, MYSQLI_ASSOC)){
      ?>
      <tr class="ticket-item" data-id="<?php echo $resultset{'id'}; ?>">

        <td class="sr_no"> <?php echo $count; ?> </td>
        <td class="title"> <?php echo $resultset{'title'}; ?> </td>
        <td class="image"> <img src='<?php echo "uploads/".$resultset{'image'}; ?>' alt =""> </td>
        <td class="status"> <?php echo $resultset{'status'}; ?> </td>
        <td class="url"> <?php echo $resultset{'url'}; ?> </td>
        <td class="dated"> <?php echo $resultset{'dated'}; ?> </td>
        <td class="actions">
          <button type="button" class="tic-view-button" data-id="<?php echo $resultset{'id'}; ?>">VIEW</button>
          <button type="button" class="tic-edit-button" data-id="<?php echo $resultset{'id'}; ?>">EDIT</button>
          <button type="button" class="tic-delete-button" data-id="<?php echo $resultset{'id'}; ?>">DELETE</button>
        </td>

        <td class="description" style="display:none;"> <?php echo $resultset{'description'}; ?> </td>
      </tr>
      <?php
      $count++;
    }

  } else { 
    echo '<tr><td colspan="7"> <strong> No Tickets Found. </strong> </td></tr>'; 
  }
  // $unique_order_id_exist = mysqli_query($con, $queryt);
  // if(mysqli_num_rows($unique_order_id_exist) > 0) {
  //   $unique_order_id_data = mysqli_fetch_array($unique_order_id_exist, MYSQLI_ASSOC);
  // } else {
  //   die("Unique order id not found!");
  // }
  // $get_unique_order_id = (!empty($unique_order_id_data{'unique_order_id'})) ? $unique_order_id_data{'unique_order_id'} : "";
} // function loadTickets end




?>