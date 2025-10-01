<!-- MARK I -->
<?php
  if (isset($_POST['mail_submit'])) {

    $fname = strip_tags( $_POST['fname'] );
    $lname = strip_tags( $_POST['lname'] );
    $phone = strip_tags( $_POST['phone'] );
    $email = strip_tags( $_POST['email'] );
    $query = strip_tags( $_POST['query'] );

    $to = "aspnetusername@gmail.com, amanpreet@intiger.in";
    $from = "info@domain.com";
    $subject = "HTML email";

    $message = "<html><head><title>Contact Form</title></head><body>";
    $message .= "<p>New Query on Website.</p>";
    $message .= '<table rules="all" style="border:1px solid #ccc;" cellpadding="10">';
    $message .= "<tr> <td>First Name</td> <td>".$fname."</td> </tr>";
    $message .= "<tr> <td>Last Name</td> <td>".$lname."</td> </tr>";
    $message .= "<tr> <td>Phone</td> <td>".$phone."</td> </tr>";
    $message .= "<tr> <td>Email</td> <td>".$email."</td> </tr>";
    $message .= "<tr> <td>Message</td> <td>".$query."</td> </tr>";
    $message .= "</table>";
    $message .= "</body></html>";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <'.$from.'>' . "\r\n";
    $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
    // $headers .= "CC: susan@example.com\r\n";

    $mail_check = mail($to, $subject, $message, $headers);
    if( $mail_check ){
      echo "Mail Sent";
    } else {
      echo "Mail Failed";
    }

  }
?>



<!-- MARK II -->
<!-- with validations -->
<?php
$output ='';
if(isset($_POST["submit"])){
  // Checking For Blank Fields.
  if($_POST["name"]=="" || $_POST["email"]=="" || $_POST["phone"]=="" || $_POST["msg"]==""){
    // echo "Fill all fields. Please try again with valid info.";
    $output = "<strong class='text-danger'>Fill all fields. Please try again with valid info.</strong>";
  } else {
    // Check if the "Sender's Email" input field is filled out
    $name  = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $msg   = htmlspecialchars($_POST['msg']);

    // Sanitize & Validate E-mail
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email){
      $output = "<strong class='text-danger'>Invalid Email detected. Please try again with valid info.</strong>";
    } else {
      $to = "amanpreet@intiger.in";
      $from = "mail@example.com";
      $subject = "New Contact Form Enquiry";

      $message = "<html><head><title>New Contact Form Enquiry</title></head><body>";
      $message .= '<table rules="all" style="border:1px solid #ddd;" cellpadding="10">';
      $message .= "<tr> <td>Name</td> <td>".$name."</td> </tr>";
      $message .= "<tr> <td>Phone</td> <td>".$phone."</td> </tr>";
      $message .= "<tr> <td>Email</td> <td>".$email."</td> </tr>";
      $message .= "<tr> <td>Details</td> <td>".$msg."</td> </tr>";
      $message .= "</table>";
      $message .= "</body></html>";

      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: <'.$from.'>' . "\r\n";
      $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
      // $headers .= "CC: susan@example.com\r\n";

      $mail_check = mail($to, $subject, $message, $headers);
      if( $mail_check ){
        $output = "<strong class='text-success'>Thanks for contacting us. We ll get back to you soon.</strong>";
      } else {
        $output = "<strong class='text-danger'>Mail sending failed. Please try again.</strong>";
      }
    }
  }
}
echo $output;
?>

<!-- HTML form -->
<form action="" method="post">
  <input type="text" name="name" placeholder="Name" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="tel" name="phone" placeholder="Phone" required>
  <textarea name="msg" placeholder="Message"></textarea>
  <input type="submit" name="submit" value="Submit">
</form>


