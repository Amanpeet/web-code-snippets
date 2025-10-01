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

    $message = "<html><head><title>Contact Form IndiaVisa</title></head><body>";
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

<form id="contactform" class="" action="" method="post">
  <div class="form-group">
    <input type="text" class="form-control" name="name" required placeholder="Name">
  </div>
  <div class="form-group">
    <input type="email" class="form-control" name="email" required placeholder="Email">
  </div>
  <div class="form-group">
    <textarea class="form-control" rows="5" name="msg" required placeholder="Message"></textarea>
  </div>
  <div class="form-group text-center">
    <button id="contactFormSubmit" type="submit" class="btn btn-light">Submit</button>
  </div>
  <div class="form-group text-center">
    <div id="contactFormResponse"></div>
  </div>
</form>

<script src="js/jquery.min.js"></script>
<script>
  $(function () {

    // send mail via ajax
    $("#contactFormSubmit").click(function(e) {
      e.preventDefault();

      var data = {
        name: $("form input[name='name']").val(),
        email: $("form input[name='email']").val(),
        msg: $("form textarea[name='msg']").val(),
      };

      $.ajax({
        type: "POST",
        url: "contact-mail.php",
        data: data,
        success: function (data) {
          console.log(data);
          $("#contactFormResponse").html(data);
          $('.success').fadeIn(1000);
        },
        error: function(err){
          console.log(err);
        }
      });
      console.log('all done');

    });

  });
</script>