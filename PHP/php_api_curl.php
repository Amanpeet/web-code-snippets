<?php
if( isset($_POST['nemail']) && !empty($_POST['nemail']) ) {

  $email = $_POST['nemail'];
  $name  = $_POST['nnamel'];

  /*
  // PHP CURL API request
  */
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://sandeepbogra.com/wp/wp-json/newsletter/v2/subscriptions");
  curl_setopt($ch, CURLOPT_POST, 1);
  // curl_setopt($ch, CURLOPT_POSTFIELDS, "client_key=ccbb2753319a12b72f8e2c1f78144d5139ef1539&client_secret=cc0f0970f175b2da6196f71c0458f035b0ffc6ae&email=xxx");
  curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query(array(
      'client_key'    => 'ccbb2753319a12b72f8e2c1f78144d5139ef1539',
      'client_secret' => 'cc0f0970f175b2da6196f71c0458f035b0ffc6ae',
      'email'         => $email,
      'first_name'    => $name,
    )));

  // Receive server response ...
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec($ch);
  curl_close ($ch);

  // print_r($server_output);
  if ($server_output == '201' ) {
    echo "done";
  } else {
    echo "nope";
  }

}

