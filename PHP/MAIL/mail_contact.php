<?php
if (isset($_POST["submit"])) {

  var_dump($_FILES);
  echo $file_tmp_name = $_FILES['fileAttach']['tmp_name'];
  echo $file_name = $_FILES['fileAttach']['name'];
  echo $file_size = $_FILES['fileAttach']['size'];
  echo $file_type = $_FILES['fileAttach']['type'];
  echo $file_error = $_FILES['fileAttach']['error'];
  // exit;

  // Checking For Blank Fields..
  if ($_POST["vname"] == "" || $_POST["vemail"] == "" || $_POST["phone"] == "" || $_POST["msg"] == "") {
    echo "Fill all fields. Please try again with valid info.";
    // header("Location: contact.html?var=invalid");
    // die();
    echo '<script type="text/javascript"> window.location = "../career.php?var=invalid" </script>';
    exit;
  } else {
    // Check if the "Sender's Email" input field is filled out
    $email = $_POST['vemail'];
    // Sanitize E-mail Address
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    // Validate E-mail Address
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
      echo "Invalid Email detected. Please try again with valid info.";
      // header("Location: contact.html?var=error");
      // die();
      echo '<script type="text/javascript"> window.location = "../career.php?var=error" </script>';
    } else {

      //subject
      $subject = 'Dove Research Labs - Career Form';

      $file = $_FILES["fileAttach"]["name"];
      $content = chunk_split(base64_encode(file_get_contents($_FILES["fileAttach"]["tmp_name"])));
      $uid = md5(uniqid(time()));
      $name = basename($file);

      // header
      $header = "From: " . $_POST["vname"] . " <" . $_POST["vemail"] . ">\r\n";
      $header .= "Reply-To: " . $_POST["vemail"] . "\r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";

      // message & attachment
      $nmessage = "--" . $uid . "\r\n";
      $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
      $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
      $nmessage .= $_POST["msg"] . "\r\n\r\n";
      $nmessage .= "--" . $uid . "\r\n";
      $nmessage .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n";
      $nmessage .= "Content-Transfer-Encoding: base64\r\n";
      $nmessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
      $nmessage .= $content . "\r\n\r\n";
      $nmessage .= "--" . $uid . "--";

      if (mail($mailto, $subject, $nmessage, $header)) {
        echo "Mail has been sent. Please wait while we redirect you back...";
        // echo $nmessage;

        // echo '<script type="text/javascript">
        //         window.location = "../career.php?var=success"
        //    </script>';

      } else {
        echo "Mail sending failed, Try again later. Please wait while we redirect you back...";
        // echo $nmessage;
        // echo '<script type="text/javascript">
        //         window.location = "../career.php?var=error"
        //    </script>';
      }


    }
    exit;
  }
}
?>