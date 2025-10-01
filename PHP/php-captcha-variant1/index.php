<h1>A Simple Example Of PHP CAPTCHA Script</h1>
<?php
  if (isset($_POST["captcha"])) {
    if ($_SESSION["captcha"] == $_POST["captcha"]) {
      //CAPTHCA is valid; proceed the message: save to database, send by e-mail …
      echo '<div class="alert alert-success">CAPTHCA is valid; proceed the message</div>';
    } else {
      echo '<div class="alert alert-danger">CAPTHCA is not valid; ignore submission</div>';
    }
  }
?>
<form role="form" method="post">
  <label for="pwd">Enter Captcha code</label>
  <img src="captcha.php" alt="captcha image">
  <input type="text" name="captcha" size="3″ maxlength=" 3″ class="form-control">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
