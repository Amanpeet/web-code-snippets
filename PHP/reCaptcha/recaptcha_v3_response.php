<?php

// for betweenfriends.in
// site key- 6LdNP8MUAAAAAMU14kWt7mnjynH16PjH60NZV2xb
// secret key- 6LdNP8MUAAAAAMmHQWNmBy1ElGlAPnviMkZmgaTN


// connect to database
define('DB_SERVER', 'betweenfriends.in');
define('DB_USERNAME', 'betweenf_andy');
define('DB_PASSWORD', 'Q4?AT3tbO8ik');
define('DB_DATABASE', 'betweenf_android');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE)
  or die("Connection error: " . mysqli_connect_error());
if ($db) {
  echo "connection establised.";
} else {
  echo "no connection. ";
}

if (isset($_POST) && !empty($_POST)) {
  echo "data received. ";
  echo "<br><br>";
  print_r($_POST);
  echo "<br><br>";
} else {
  echo "no data yet";
}


// process captcha
if (isset($_POST['captcha_token']) && !empty($_POST['captcha_token']) ) {
  $captcha = $_POST['captcha_token'];
  $secret = '6LdNP8MUAAAAAMmHQWNmBy1ElGlAPnviMkZmgaTN'; //your secret key
  $handle = curl_init('https://www.google.com/recaptcha/api/siteverify');
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, "secret=$secret&response=$captcha");
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($handle);
  $explodedArr = explode(",",$response);
  $doubleExplodedArr = explode(":",$explodedArr[0]);
  $captchaConfirmation = end($doubleExplodedArr);
  if(trim($captchaConfirmation) == "true") {
    echo "captcha success. YOU ARE HUMAN (^_^) ";
    // login(); //your login function
  } else {
    echo "captcha failed. YOU ARE NOT HUMAN! ";
  }
} else {
  echo "captcha not found. ";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Recaptcha v3</title>

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://www.google.com/recaptcha/api.js?render=6LdNP8MUAAAAAMU14kWt7mnjynH16PjH60NZV2xb"></script>

  <script>
    $(function(){

      // request a token
      grecaptcha.ready(function() {
        grecaptcha.execute('6LdNP8MUAAAAAMU14kWt7mnjynH16PjH60NZV2xb', {action: 'create_comment'}).then(function(token) {
          $('#captcha_token').val(token);
          console.log('token set');
        });
      });

      // $('#recaptcha_form').one('submit', function(e){
      //   e.preventDefault();
      //   console.log('lets see');
      //   $(this).submit();
      // });

    });
  </script>

</head>
<body>

  <!-- FORM GOES HERE -->
  <form id='recaptcha_form' method="post" action="">
    <input type="hidden" name="captcha_token" id="captcha_token">
    <label>Username</label>
    <input type="text" name="username">
    <label>Password</label>
    <input type="password" name="password">
    <button type="submit" id="login_btn" name="login_btn" value="submit">Login</button>
  </form>

</body>
</html>