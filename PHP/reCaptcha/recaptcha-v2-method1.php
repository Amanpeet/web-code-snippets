<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$web_email;
$message;
$captcha;
// check form is submitted
if (isset($_POST['web_email'])) {

  // get values
  $name =            $_POST["name"];
  $visitor_email =   $_POST['web_email'];
  $message =         $_POST['message'];

  //Validate first
  if (empty($name) || empty($visitor_email)) {
    $error = "Name and email are needed!";
  }

  if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
  }

  if (!$captcha) {
    echo '<h2>Please check the the captcha form.</h2>';
    exit;
  }

  $secretKey = "SECRET-KEY";
  $ip = $_SERVER['REMOTE_ADDR'];
  // post request to server
  $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' .
    urlencode($secretKey) .  '&response=' . urlencode($captcha);
  $response = file_get_contents($url);
  $responseKeys = json_decode($response, true);
  // should return JSON with success as true
  if ($responseKeys["success"]) {
    // echo '<h3>Thanks for contacting us</h3>';

    // mail then
    $to = "youremail@yourdomain.com";
    $email_subject = "CG Recaptcha Form2 submission";
    $email_body = "You have received a new message from " . $name . ".\n" .
      "sender's email:\n " . $visitor_email . "\n" .
      "Here is the message:\n " . $message;

    //Send the email!
    $mail_check = mail($to, $email_subject, $email_body);
    if ($mail_check) {
      // echo "all is well. mail sent";
      header('Location: thank_you_SO2.html');
    } else {
      echo '<h2>You are a spammer ! Go Away</h2>';
    }
  }
}
?>


<!-- //ANOTHER SHOT -->
<?php
$error = false;
$output = '';

$name    = $_POST["name"];
$email   = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
  $output = "<span style='color: red;font-weight: bold;'>Fyll i alla fält!</span>";
  $error = true;
}
if (empty($_POST['g-recaptcha-response'])) {
  $output = "<span style='color: red;font-weight:bold;'>reCaptchan är inte ifylld!</span>";
  $error = true;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $output =  "<span style='color: red;font-weight: bold;'>Du måste skriva in en giltig e-mail adress!</span>";
  $error = true;
}
if ($error) {
  echo $output;
} else {
  $secretKey = "YOUR-SECRET-KEY";
  $captcha=$_POST['g-recaptcha-response'];
  $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' .
    urlencode($secretKey) .  '&response=' . urlencode($captcha);
  $response = file_get_contents($url);
  $responseKeys = json_decode($response, true);
  if ($responseKeys["success"]) {

    // mail then
    $to = $email;
    $email_subject = $subject;
    $email_body = "Name: $name\n From: $name\n Message: $message";
    //Send the email!
    $mail_check = mail($to, $email_subject, $email_body);
    if ($mail_check) {
      echo "Mail Sent!";
    } else {
      echo 'Mail Failed';
    }
  } else {
    echo 'Response not Success';
  }
}
?>
