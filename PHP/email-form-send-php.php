<form method="post" action="">
  <div class="form-group">
    <input class="input" required placeholder="Name" name="ename" type="text">
  </div>
  <div class="form-group">
    <input class="input" required placeholder="Email" name="eemail" type="email">
  </div>
  <div class="form-group">
    <input class="input" required placeholder="Phone" name="ephone" type="text">
  </div>
  <div class="form-group">
    <textarea class="input1" placeholder="Query" name="equery" type="text"></textarea>
  </div>
  <div class="form-group">
    <input value="Submit" name="submit" class="m-bt pull-right" type="submit">
  </div>
</form>

<?php
if(isset($_POST["submit"])){
  // Checking For Blank Fields
  if($_POST["ename"]==""||$_POST["eemail"]==""||$_POST["ephone"]==""||$_POST["equery"]==""){
    echo "Fill all fields. Please try again with valid info.";
  } else {
    // Check if the "Sender's Email" input field is filled out
    $email=$_POST['eemail'];
    $email =filter_var($email, FILTER_SANITIZE_EMAIL);
    $email= filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email){
      echo "Invalid Email detected. Please try again with valid info.";
    }
    else{
      // Compose the email message to send
      $to = "amanpreet@intiger.in";
      $from = $_POST['cemail'];
      $subject = "New Enquiry Form";
      $headers = 'From:'. $from . "\r\n";
      $message = "Name: " . $_POST['cname'] . "\r\n";
      $message .= "Email: " . $_POST['cemail'] . "\r\n";
      $message .= "Phone: " . $_POST['cphone'] . "\r\n\r\n";
      $message .= "Query: " .$_POST['cmessage'];
      // Send Mail By PHP Mail Function
      if(mail($to, $subject, $message, $headers) ){
        echo "Message sent successfully! We will contact to you soon.";
        // echo '<script type="text/javascript">
        //      alert("Query submitted successfully! We will get back to you soon.");
        // </script>';
      } else {
        echo "Message sending failed! Please try again later.";
        // echo '<script type="text/javascript">
        //      alert("Query submitted successfully! We will get back to you soon.");
        // </script>';
      }
    }
  }
}
?>