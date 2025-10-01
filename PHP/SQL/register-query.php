<?php

//process form data
if( isset($_POST['register_submit']) && !empty($_POST['register_submit'])  ){

  //set errors
  $errors = 0;

  // validate captcha
  if( isset($_POST['form_captcha']) && !empty($_POST['form_captcha'])  ){
    $form_captcha = $_POST['form_captcha'];
    if( $form_captcha == $_SESSION['code'] ){
      // echo "captcha validation successfull. ";
    } else {
      $errors = "<h5 class='text-danger'> ERROR: Captcha validation failed. </h5>";
    }
  } else {
    $errors = "<h5 class='text-danger'> ERROR: Form captcha not found. </h5>";
  }

  $errors = 0;
  //chck if any error found
  if( $errors === 0 ){

    $error = false;

    // Required field names
    $required_fields = array(
      'form_type',
      'username',
      'email',
      'password',
      'password2',
      'fullname',
      'phone',
      'phone2',
      'address',
      'state',
      'city',
      'pincode',
      'dob',
      'gender',
    );
    foreach($required_fields as $field) {
      if ( !isset( $_POST[$field] ) || empty( $_POST[$field] ) ) {
        $error = true;
        echo "<h5 class='text-danger'> ERROR: Required fields Empty or Invalid. </h5>".$_POST[$field];
      } else {
        $trim_val = mysqli_real_escape_string($conn, $_POST[$field]);
        if ( trim($trim_val) == '' ){
          $error = true;
          echo "<h5 class='text-danger'> ERROR: Required fields cant be just spaces. </h5>";
        }
      }
    }

    // Set Optional Values
    $optional_fields = array(
      'job_category',
      'job_location',
      'edu_qualification',
      'edu_institute',
      'edu_course',
      'edu_year',
      'skill_name',
      'skill_exp',
      'file_resume',
      'com_name',
      'com_industry',
      'com_location',
      'com_website',
      'com_phone',
      'com_email',
      'com_address',
      'com_state',
      'com_city',
      'com_pincode',
      'file_identification',
    );
    foreach($optional_fields as $fieldo) {
      $fieldo_value = "";
      if ( isset( $_POST[$fieldo] ) && !empty( $_POST[$fieldo] ) ) {
        $fieldo_value = mysqli_real_escape_string($conn, $_POST[$fieldo]);
      }
      $_POST[$fieldo] = $fieldo_value; //not errors
    }

    // Confirm Employer or User
    if ( $_POST['form_type'] != 'employer' && $_POST['form_type'] != 'user') {
      $error = true;
      echo "<h5 class='text-danger'> ERROR: Register type Unknown. </h5>";
    }

    // Confirm Password
    if( $_POST["password"] != $_POST["password2"] ) {
      $error = true;
      echo "<h5 class='text-danger'> ERROR: Passwords do not match. Please try again. </h5>";
    }

    // Validate Password strength
    $uppercase = preg_match('@[A-Z]@', $_POST['password']);
    $lowercase = preg_match('@[a-z]@', $_POST['password']);
    $number    = preg_match('@[0-9]@', $_POST['password']);
    if( !$uppercase || !$lowercase || !$number || strlen($_POST['password']) < 8 ) {
      $error = true;
      echo "<h5 class='text-danger'> ERROR: Password should be over 8 chars with a Uppercase, Lowercase & Number.</h5>";
    }

    // Validate username
    if( !preg_match('/^[a-z0-9]{4,20}$/', $_POST['username']) ){
      $error = true;
      echo "<h5 class='text-danger'> ERROR: Username seems invalid. Please try again. </h5>";
    }

    //if not any error
    if ( !$error) {

      //set field vars
      $form_type = mysqli_real_escape_string($conn, $_POST['form_type']);
      $username  = mysqli_real_escape_string($conn, $_POST['username']);
      $email     = mysqli_real_escape_string($conn, $_POST['email']);
      $password  = mysqli_real_escape_string($conn, $_POST['password']);
      $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
      $fullname  = mysqli_real_escape_string($conn, $_POST['fullname']);
      $phone     = mysqli_real_escape_string($conn, $_POST['phone']);
      $phone2    = mysqli_real_escape_string($conn, $_POST['phone2']);
      $address   = mysqli_real_escape_string($conn, $_POST['address']);
      $state     = mysqli_real_escape_string($conn, $_POST['state']);
      $city      = mysqli_real_escape_string($conn, $_POST['city']);
      $pincode   = mysqli_real_escape_string($conn, $_POST['pincode']);
      $dob       = mysqli_real_escape_string($conn, $_POST['dob']);
      $gender    = mysqli_real_escape_string($conn, $_POST['gender']);

      $password = md5($password);
      $status = "active";

      //Check username and password from database
      $sql1 = "SELECT * FROM users WHERE `username`='$username' ";
      $sql2 = "SELECT * FROM users WHERE `email`='$email' ";
      $result1 = mysqli_query($conn, $sql1);
      $result2 = mysqli_query($conn, $sql2);

      if( mysqli_num_rows($result1) > 0 ) { //existing username
        echo "<h5 class='text-danger'> ERROR: User already exists with same Username. </h5>";

      } elseif( mysqli_num_rows($result2) > 0 ){ //existing email
        echo "<h5 class='text-danger'> ERROR: User already exists with same Email Address. </h5>";

      } else { // Register data

        $main_sql = "INSERT INTO `users`( `username`, `email`, `password`, `fullname`, `role`, `status` ) VALUES ( '$username', '$email', '$password', '$fullname', '$form_type', '$status' )";
        $main_que = mysqli_prepare($conn, $main_sql);

        if( $main_que ){
          mysqli_stmt_execute($main_que);
          echo "<h5 class='text-success'> SUCCESS: Registration Successfull. You can login now!</h5>";

          $data_sql = "INSERT INTO `userdata`( `form_type`, `username`, `email`, `fullname`, `phone`, `phone2`, `address`, `state`, `city`, `pincode`, `dob`, `gender` ) VALUES ( '$form_type', '$username', '$email', '$fullname', '$phone', '$phone2', '$address', '$state', '$city', '$pincode', '$dob', '$gender' )";
          $data_que = mysqli_prepare($conn, $data_sql);
          if( $data_que ){
            mysqli_stmt_execute($data_que);
            // echo "<h5 class='text-success'> SUCCESS: Userdata Registered.</h5>";
          } else {
            // echo "<h5 class='text-danger'> ERROR: Userdata Insert failed. </h5>";
          }

          //SEND MAIL TO ALERT ADMINS
          // $form_type = "Quick Travellers Form";
          // $query = "New Quick Travellers Form Filled on IndiaVisa.co.uk UK Website.";
          // $to = "enquiry@indiavisa.co.uk";
          // // $to = "amanpreet@intiger.in";
          // $from = "alert@indianevisaonline.com";
          // $subject = "IndiaVisa.co.uk New Quick Travellers Form";
          // $message = "<html><head><title>New Quick Travellers Form</title></head><body>";
          // $message .= "<p>New Quick Travellers Form on IndiaVisa.co.uk UK Website.</p>";
          // $message .= '<table rules="all" style="border:1px solid #ccc;" cellpadding="10">';
          // $message .= "<tr> <td>Visa Type</td> <td>".$pay_type." (Quick Form) </td> </tr>";
          // $message .= "<tr> <td>Travellers</td> <td>".$qck_travellers."</td> </tr>";
          // $message .= "<tr> <td>Form ID</td> <td>".$qck_id."</td> </tr>";
          // $message .= "<tr> <td>Email</td> <td>".$user_email."</td> </tr>";
          // $message .= "<tr> <td>Source</td> <td>".$query."</td> </tr>";
          // $message .= "</table>";
          // $message .= "</body></html>";
          // $headers = "MIME-Version: 1.0" . "\r\n";
          // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          // $headers .= 'From: <'.$from.'>' . "\r\n";
          // $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
          // $mail_check = @mail($to, $subject, $message, $headers);

        } else {
          echo "<h5 class='text-danger'> ERROR: Registration failed. Try again later. </h5>";
        }

      }
    }

  } else {
    echo $errors;
  }

}//end process

