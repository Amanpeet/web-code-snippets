<html>

<head>
  <title>Test Form</title>
</head>

<body>
  <form action="" method="post">
    Enter Image Text
    <input name="captcha" type="text">
    <img src="captcha.php" /><br>
    <input name="submit" type="submit" value="Submit">
  </form>
</body>

</html>

<?php
session_start();
if(isset($_POST["captcha"]) && $_POST["captcha"]!="" && $_SESSION["code"]==$_POST["captcha"]) {
  echo "Correct Code Entered";
  //Do you stuff
} else {
  die("Wrong Code Entered");
}
?>