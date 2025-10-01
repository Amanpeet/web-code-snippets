<?php
// error_reporting(0);
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'srdpharm_user');
define('DB_PASSWORD', '6h#BRxaAguP5');
define('DB_DATABASE', 'srdpharm_customdb');
$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE)
or die("Connection error: cant connect to Database.");
// or die("Connection error: " . mysqli_connect_error());


$data_sql = "INSERT INTO `userdata`( `form_type`, `username`, `email`, `fullname`, `phone`, `phone2`, `address`, `state`, `city`, `pincode`, `dob`, `gender` ) VALUES ( '$form_type', '$username', '$email', '$fullname', '$phone', '$phone2', '$address', '$state', '$city', '$pincode', '$dob', '$gender' )";
$data_que = mysqli_prepare($conn, $data_sql);

if( $data_que ){
  mysqli_stmt_execute($data_que);
  echo "<h5 class='text-success'> SUCCESS: Userdata Registered.</h5>";
} else {
  echo "<h5 class='text-danger'> ERROR: Userdata Insert failed. </h5>";
}


