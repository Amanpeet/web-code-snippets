<!-- DOCS: https://developers.google.com/recaptcha/docs/display -->

<html>
  <head>
    <title>reCAPTCHA demo: Simple page</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <form action="?" method="POST">
      <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>
      <br/>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>

<?php 
if(isset($_REQUEST['homesubmit'])){
  $captcha = $_REQUEST['g-recaptcha-response'];
  $handle = curl_init('https://www.google.com/recaptcha/api/siteverify');
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, "secret=YOUR_SECRET_KEY&response=$captcha");
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($handle);
  $explodedArr = explode(",",$response);
  $doubleExplodedArr = explode(":",$explodedArr[0]);
  $captchaConfirmation = end($doubleExplodedArr);

  if(trim($captchaConfirmation) == "true") {

    $cleanedFrom = $_POST['email']; 
    $to ='amanpreet@intiger.in';
    $subject = 'Form';
    $headers = "From: " . $cleanedFrom . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $message = '';
    $message .= "<strong>First Name:</strong> " .$_POST['fname'] ;
    $message .= "<strong>Last Name:</strong> " .$_POST['lname'] ;
    $message .= "<strong>Phone:</strong> " . $_POST['phone'] ; 
    $message .= "<strong>Email:</strong> " . $_POST['email'];
    $message .= "<strong>Message:</strong> " . $_POST['message'] ; 
    $send = mail($to, $subject, $message, $headers);
    if($send) {
      echo "<script> alert('Message Sent. Thank You!!!') </script>";
    } else {
      echo "<script> alert('Message Not Sent. Please try again') </script>";
    }

  } else {
    echo "<script> alert('Captcha entry was wrong. Please try again') </script>";
  }
} 
?>