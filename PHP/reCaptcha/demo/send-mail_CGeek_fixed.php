<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// check form is submitted
if ( isset($_POST['form_submit']) ) {

  // get values
  $error = ''; //error variable
  $visitor_name    = $_POST['name'];
  $visitor_email   = $_POST['email'];
  $visitor_message = $_POST['message'];
  $captcha         = $_POST['g-recaptcha-response'];

  //required values
  if ( empty($visitor_name) || empty($visitor_email) ) {
    $error = "<h3>Name and Email are required. END.</h3>";
  }

  //required captcha
  if ( empty($captcha) ) {
    $error = "<h3>Please check the the captcha form. END.</h3>";
  }

  // if no errors
  if( empty($error) ){

      $secretKey = "6LfRPaQUAAAAAFdGoYTnhgeJHv4jY3bv8BCglE4B";
      $ip = $_SERVER['REMOTE_ADDR'];
      // post request to server
      $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' .
        urlencode($secretKey) .  '&response=' . urlencode($captcha);
      $response = file_get_contents($url);
      $responseKeys = json_decode($response, true);
      // should return JSON with success as true

      if ($responseKeys["success"]) {
        echo '<h3>Captcha Success. Writing Mail...</h3>';

        // write mail
        // $to = "john@coinsandhistory.com";
        $to = "aspnetusername@gmail.com";
        $email_subject = "CG Recaptcha Form2 submission";
        $email_body = "You have received a new message from " . $visitor_name . ".\n" .
          "sender's email:\n " . $visitor_email . "\n" .
          "Here is the message:\n " . $visitor_message;

        //Send the mail
        $mail_check = mail($to, $email_subject, $email_body);
        if ($mail_check) {
          echo "<h5>Mail sending successfull. Redirecting... </h5>";
          echo '<script> window.location.href = "thank_you_SO2.html"; </script>';
        } else {
          echo "<h5>Mail sending failed. END. </h5>";
        }

      } else { // if response not success
        echo '<h3>reCaptcha verification failed!</h3>';
        echo "Response from reCaptcha: <br>";
        print_r($responseKeys);
      }

  } else { //if errors
    echo $error;
    exit;
  }
}
