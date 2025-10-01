<form class="contact_form" action="" method="POST" enctype="multipart/form-data">
  <input name="sub" type="hidden" class="form-control" value="subject">
  <div class="form-group">
    <input name="vname" type="text" class="form-control" placeholder="Full Name">
  </div>
  <div class="form-group">
    <input name="vemail" type="email" class="form-control" placeholder="Your Email">
  </div>
  <div class="form-group">
    <input name="phone" type="text" class="form-control" placeholder="Phone No.">
  </div>
  <div class="form-group">
    <textarea name="msg" class="form-control" placeholder="Type your Query"></textarea>
  </div>
  <div class="form-group">
    <input type="file" name="attachment" id="fileToUpload">
  </div>
  <input id="send" name="submit" class="m-bt pull-right" type="submit" value="Submit">
</form>

<?php
if (isset($_POST["submit"])) {
  // Checking For Blank Fields..
  if ($_POST["vname"] == "" || $_POST["vemail"] == "" || $_POST["phone"] == "" || $_POST["msg"] == "") {
    echo "Fill all fields. Please try again with valid info.";
    exit;
  } else {
    //validations
    $email = $_POST['vemail'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
      echo "Invalid Email detected. Please try again with valid info.";
      exit;
    } else {
      //prepare the mail
      $fromEmail   = $_POST['vemail'];
      $fromName    = $_POST['vname'];
      $htmlMessage = $_POST['msg'];

      $to      = "amanpreet@intiger.in";
      $sender  = "info@doveresearchlab.com";
      $subject = "Dove Research Lab - Career Form";

      // $htmlMessage = "<html><head><title>Alumni Form DMMKKR</title></head><body>";
      $htmlMessage .= "<p>New Alumni Meet Registration Form 2019 on Website.</p>";
      $htmlMessage .= "<table rules='all' style='border:1px solid #ccc;' cellpadding='10'>";
      // $message .= "<tr> <td>First</td> <td>".$fname."</td> </tr>";
      $htmlMessage .= "<tr> <td style='width:30%;'> Alumni name </td> <td>".$f5_alumni_name."</td> </tr>";
      $htmlMessage .= "<tr> <td> Father name </td> <td>".$f5_father_name."</td> </tr>";
      $htmlMessage .= "<tr> <td> Husband name </td> <td>".$f5_husband_name."</td> </tr>";
      $htmlMessage .= "<tr> <td> Date_of_birth </td> <td>".$f5_date_of_birth."</td> </tr>";
      $htmlMessage .= "<tr> <td> Event specify </td> <td>".$f5_event_specify."</td> </tr>";
      $htmlMessage .= "</table>";
      // $htmlMessage .= "</body></html>";

      // send email with attachments if found
      $tmpName  = $_FILES['attachment']['tmp_name'];
      if (file($tmpName)) {

        $maxTotalAttachments = 2097152; //Maximum of 2 MB total attachments, in bytes
        $boundary_text = "anyRandomStringOfCharactersThatIsUnlikelyToAppearInEmail";
        $boundary = "--" . $boundary_text . "\r\n";
        $boundary_last = "--" . $boundary_text . "--\r\n";

        // Make list of attachments, getting size, adding boundaries as needed
        $emailAttachments = "";
        $totalAttachmentSize = 0;

        foreach ($_FILES as $file) {
          //In case some file inputs are left blank - ignore them
          if ($file['error'] == 0 && $file['size'] > 0) {
            $fileContents = file_get_contents($file['tmp_name']);
            $totalAttachmentSize += $file['size']; //size in bytes
            $emailAttachments .= "Content-Type: "
              . $file['type'] . "; name=\"" . basename($file['name']) . "\"\r\n"
              . "Content-Transfer-Encoding: base64\r\n"
              . "Content-disposition: attachment; filename=\""
              . basename($file['name']) . "\"\r\n"
              . "\r\n"
              . chunk_split(base64_encode($fileContents))
              . $boundary;
          }
        }
        if ($totalAttachmentSize == 0) {
          echo "Message not sent. Either no file was attached, or it was bigger than PHP is configured to accept.";
        }
        //Now make sure it doesn't exceed this function's specified limit:
        else if ($totalAttachmentSize > $maxTotalAttachments) {
          echo "Message not sent. Total attachments can't exceed " .  $maxTotalAttachments . " bytes.";
        }

        //Everything is OK - let's build up the email
        else {
          $headers = 'From:' . $sender . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n"
            . "Content-Type: multipart/mixed; boundary=\"$boundary_text\"" . "\r\n";
          $body .= "If you can see this, your email client "
            . "doesn't accept MIME types!\r\n"
            . $boundary;
          $body .= $emailAttachments;
          $body .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n"
            . "Content-Transfer-Encoding: 7bit\r\n\r\n"
            . $htmlMessage . "\r\n"
            . $boundary_last;



          if (mail($to, $subject, $body, $headers)) {
            echo "<h4>Thanks!</h4> Email successfully Sent!<br />";
          } else {
            echo 'Error - Email not sent, Try again later.';
          }
        }
      } else {

        // send plain email
        $body = $htmlMessage;
        $headers = 'From:' . $sender . "\r\n"; // Sender's Email
        if (mail($to, $subject, $htmlMessage, $headers)) {
          echo "<h4>Thanks!</h4> Email successfully Sent!<br />";
        } else {
          echo 'Error - Email not sent, Try again later.';
        }
      }
    }
  }
}
?>