<?php
$output ='';

if(isset($_POST["submit"])){

  $error = 0;
  $name = $_POST["name"];
  $eth_address = $_POST["eth"];

  $eth_pattern = "/^0x[a-fA-F0-9]{40}$/";
  // echo preg_match($eth_pattern, $eth_address);
  if( !preg_match($eth_pattern, $eth_address) ){
    $error = true;
    $output = "<h4 class='text-danger'>ETH Address seems invalid. Please try again with valid info. </h4>";
  }

  if( empty($eth_address) || empty($name) ){
    $error = true;
    $output = "<h4 class='text-danger'>Fill all fields. Please try again with valid info. </h4>";
  }

  if( !$error ){

    // connection
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'wwwmmeta_userx');
    define('DB_PASSWORD', 'S!b?Q$UyT!!N');
    define('DB_DATABASE', 'wwwmmeta_coredb');
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE)
    or die("Connection error: cant connect to Database.");

    // query
    $data_sql = "INSERT INTO `register_data`( `name`, `eth_address` ) VALUES ( '$name', '$eth_address' )";
    $data_que = mysqli_prepare($conn, $data_sql);
    if( $data_que ){
      mysqli_stmt_execute($data_que);
      $output = "<h4 class='text-success'>SUCCESS: Data Inserted Successfully! </h4>";
    } else {
      $output = "<h4 class='text-danger'>ERROR: Data Insert failed. </h4>";
    }

    // Send Email
    if ($data_que){

      $to = "amanpreet@intiger.in";
      $from = "mail@metabows.io";
      $subject = "New User Registration";

      $message = "<html><head><title>New User Registration</title></head><body>";
      $message .= '<table rules="all" style="border:1px solid #ddd;" cellpadding="10">';
      $message .= "<tr> <td>Full Name</td> <td>".$name."</td> </tr>";
      $message .= "<tr> <td>ETH Address</td> <td>".$eth_address."</td> </tr>";
      $message .= "</table>";
      $message .= "</body></html>";

      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: <'.$from.'>' . "\r\n";
      $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
      // $headers .= "CC: susan@example.com\r\n";

      $mail_check = mail($to, $subject, $message, $headers);
      if( $mail_check ){
        $output .= "<h5 class='text-success'>Thanks for contacting us. We will get back to you soon.</h5>";
      } else {
        $output .= "<h5 class='text-danger'>Mail sending failed. Please try again.</h5>";
      }
    }

  }
}

echo $output;
