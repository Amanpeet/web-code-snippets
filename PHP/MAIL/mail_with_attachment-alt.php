<?php

//file
$f5_attached = '';
$path = '';
$fileserr_doc1 = false;
$uniqd = round(microtime(true));
if( ($_FILES['f5_attached']['size'] == 0) ){
  $f5_attached = '';
  $fileserr_doc1 = false;
} else if( $_FILES['f5_attached']['size'] > (1*1024*1024) ) { //1MB
  $fileserr_doc1 = true;
} else {
  $temp        = explode(".", $_FILES["f5_attached"]["name"]);
  $newfilename = $uniqd . '_alumni' . '.' . end($temp);
  $imagetmp    = trim($_FILES['f5_attached']['tmp_name']);
  $path        = "uploads/".$newfilename;
  move_uploaded_file($imagetmp, $path);
  $f5_attached = $newfilename;
  $fileserr_doc1 = false;
}

//no files error
if( $fileserr_doc1 ){
  echo "<strong class='text-danger'>ERROR: Required files Missing or Invalid. Max Size Allowed: 1MB each.</strong>";
} else {

  $to = "amanpreet@intiger.in";
  $from = "mail@dmmkkr.com";
  $subject = "Alumni Meet Registration Form 2019";
  $message = "<html><head><title>Alumni Form DMMKKR</title></head><body>";
  $message .= "<p>New Alumni Meet Registration Form 2019 on Website.</p>";
  $message .= "<table rules='all' style='border:1px solid #ccc;' cellpadding='10'>";
  // $message .= "<tr> <td>First</td> <td>".$fname."</td> </tr>";
  $message .= "<tr> <td style='width:30%;'> Alumni name </td> <td>".$f5_alumni_name."</td> </tr>";
  $message .= "<tr> <td> Father name </td> <td>".$f5_father_name."</td> </tr>";
  $message .= "<tr> <td> Husband name </td> <td>".$f5_husband_name."</td> </tr>";
  $message .= "<tr> <td> Date_of_birth </td> <td>".$f5_date_of_birth."</td> </tr>";
  $message .= "<tr> <td> Event specify </td> <td>".$f5_event_specify."</td> </tr>";
  $message .= "</table>";
  $message .= "</body></html>";
  $final_message = "";

  // send email with attachments if found
  if (file($path)) { //path of file after moving

    $maxTotalAttachments = 2097152; //Maximum of 2 MB total attachments, in bytes
    $boundary_text = "anyRandomStringOfCharactersThatIsUnlikelyToAppearInEmail";
    $boundary = "--".$boundary_text."\r\n";
    $boundary_last = "--".$boundary_text."--\r\n";
    $emailAttachments = "";
    $totalAttachmentSize = 0;

    // foreach ($_FILES as $file) {
    //   $fileContents = file_get_contents($file['tmp_name']);
    //   $totalAttachmentSize += $file['size']; //size in bytes
    //   $emailAttachments .= "Content-Type: "
    //   .$file['type'] . "; name=\"" . basename($file['name']) . "\"\r\n"
    //   ."Content-Transfer-Encoding: base64\r\n"
    //   ."Content-disposition: attachment; filename=\""
    //   .basename($file['name']) . "\"\r\n"
    //   ."\r\n"
    //   .chunk_split(base64_encode($fileContents))
    //   .$boundary;
    // }

    $fileContents = file_get_contents($path);
    $totalAttachmentSize += filesize($path); //size in bytes
    $file_parts = pathinfo($path);
    $emailAttachments .= "Content-Type: "
    .$file['type'] . "; name=\"" . $file_parts['basename'] . "\"\r\n"
    ."Content-Transfer-Encoding: base64\r\n"
    ."Content-disposition: attachment; filename=\""
    . $file_parts['basename'] . "\"\r\n"
    ."\r\n"
    .chunk_split(base64_encode($fileContents))
    .$boundary;

    if ($totalAttachmentSize == 0) {
      echo "<strong> Mail Attachment Failed. </strong> ";
    } else {
      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= 'From: <'.$from.'>' . "\r\n";
      $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
      $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary_text\"" . "\r\n";
      $final_message .= "If you can see this, your email client " ."doesn't accept MIME types!\r\n" .$boundary;
      $final_message .= $emailAttachments;
      $final_message .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n" ."Content-Transfer-Encoding: 7bit\r\n\r\n" .$message . "\r\n" .$boundary_last;
      echo "<strong> Mail Attachment Attached. </strong> ";
    }

  } else {
    echo "<strong> Mail Simply. </strong> ";
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <'.$from.'>' . "\r\n";
    $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
    // $headers .= "CC: susan@example.com\r\n";
    $final_message = $message;
  }

  $to = "amanpreet@intiger.in";
  $mail_check = mail($to, $subject, $final_message, $headers);
  if( $mail_check ){
    echo "<strong> Mail Sent. </strong> ";
  } else {
    echo "<strong> Mail Failed. </strong> ";
  }

}