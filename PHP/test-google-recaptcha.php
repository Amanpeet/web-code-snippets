<?php /*
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="modal-content">
  <form method="post" action="">
    <div class="col-sm-6 form-group">
      <label for="l_first_name" title="fname">First Name* : </label>
      <input placeholder="First Name" id="l_first_name" class="input-field form-control" name="fname" value="" required="" type="text">
    </div>
    <div class="col-sm-6 form-group">
      <label for="l_last_name" title="lname">Last Name : </label>
      <input placeholder="Last Name" id="l_last_name" class="input-field form-control" name="lname" value="" type="text">
    </div>
    <div class="col-sm-6 form-group">
      <label for="l_phone_no" title="phone">Phone* : </label>
      <input placeholder="Phone" id="l_phone_no" class="input-field form-control" name="phone" value="" required="" type="text">
    </div>
    <div class="col-sm-6 form-group">
      <label for="l_email" title="email">Email* : </label>
      <input placeholder="Email" id="l_email" class="input-field form-control" name="email" value="" required="" type="text">
    </div>
    <div class="col-sm-12 form-group">
      <label for="l_comments" title="message">Message : </label>
      <textarea placeholder="Message" name="message" id="l_comments" class="form-control"></textarea>
    </div>
    <div class="g-recaptcha" data-sitekey="6LcNjJAUAAAAACrt5KqkvqB9fROLQT73yXlLlGv4"></div>
    <div class="modal-footer">
      <input type="submit" id="l_submit_btn" name="homesubmit" class="btn btn-primary button" value="Request" />
    </div>
  </form>
  <?php
  if (isset($_REQUEST['homesubmit'])) {
    $captcha = $_REQUEST['g-recaptcha-response'];
    $handle = curl_init('https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, "secret=6LcNjJAUAAAAANsgaxANKeHDC5DzDdKNVJmWgZgx&response=$captcha");
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);
    $explodedArr = explode(",", $response);
    $doubleExplodedArr = explode(":", $explodedArr[0]);
    $captchaConfirmation = end($doubleExplodedArr);

    if (trim($captchaConfirmation) == "true") {
      echo "Captcha Correct. Well Done.";
    } else {
      echo "Captcha Wrong. Please try again";
    }
  }
  ?>
</div>
*/ ?>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<form action="" method="post">
  <div>
    <span>Name</span>
    <input type="text" name="name" placeholder="Your Name" required>
  </div>
  <div>
    <span>Email</span>
    <input type="email" name="web_email" placeholder="youremail@domain.com" required>
  </div>
  <div>
    <span>Messgae</span>
    <textarea name="message" placeholder="message" required></textarea>
  </div>
  <!--  Google v2 Recaptcha Form   -->
  <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>
  <div class="code">
    <input type="submit" name="submit" value="Send">
  </div>
</form>

<?php
//check form is submitted
if( isset($_POST['submit']) ){

  // get values
  $error = '';
  $name          = $_POST["name"];
  $visitor_email = $_POST['web_email'];
  $message       = $_POST["message"];

  //Validate first
  if(empty($name)||empty($visitor_email)) {
    $error = "Name and email are needed!";
  }

  //handle captcha response
  $captcha = $_REQUEST['g-recaptcha-response'];
  $handle = curl_init('https://www.google.com/recaptcha/api/siteverify');
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, "secret=YOUR_SECRET_KEY&response=$captcha");
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($handle);
  $explodedArr = explode(",",$response);
  $doubleExplodedArr = explode(":",$explodedArr[0]);
  $captchaConfirmation = end($doubleExplodedArr);
  print_r($doubleExplodedArr);
  if ( trim($captchaConfirmation) != "true" ) {
    $error = "<p>You are a bot! Go away!</p>";
  }

  if( empty($error) ){ //no error
    // mail than
    $to = "amanpreet@intiger.in";
    $email_subject = "New Form submission";
    $email_body = "You have received a new message from ".$name.".\n".
    "sender's email:\n ".$visitor_email."\n".
    "Here is the message:\n ".$message;
    $headers = "From: ".$visitor_email." \r\n";
    $headers .= "Reply-To: ".$visitor_email." \r\n";
    //Send the email!
    $mail_check = mail($to,$email_subject,$email_body,$headers);
    if( $mail_check ){
      // echo "all is well. mail sent";
      header('Location: thank_you.html');
    } else {
      echo "mail failed. try again";
    }
  } else {
    echo $error;
  }
}
?>