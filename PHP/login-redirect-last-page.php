<?php
/*
A common way to do this is to pass the user's current page to the Login form via a $_GET variable.
For example: if you are reading an Article, and you want to leave a comment. The URL for comments is comment.php?articleid=17. While comment.php is loading, it notices that you are not logged in. It wants to send you to login.php, like you showed earlier. However, we're going to change your script so that is also tells the login page to remember where you are:
*/


header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
// Note: $_SERVER['REQUEST_URI'] is your current page




//  login.php
echo '<input type="hidden" name="location" value="';
if (isset($_GET['location'])) {
  echo htmlspecialchars($_GET['location']);
}
echo '" />';
//  Will show something like this:
//  <input type="hidden" name="location" value="comment.php?articleid=17" />



//  login-check.php
session_start();

//  our url is now stored as $_POST['location'] (posted from login.php). If it's blank, let's ignore it. Otherwise, let's do something with it.
$redirect = NULL;
if ($_POST['location'] != '') {
  $redirect = $_POST['location'];
}

if ((empty($username) or empty($password) and !isset($_SESSION['id_login']))) {
  $url = 'login.php?p=1';
  // if we have a redirect URL, pass it back to login.php so we don't forget it
  if (isset($redirect)) {
    $url .= '&location=' . urlencode($redirect);
  }
  header("Location: " . $url);
  exit();
} elseif (!user_exists($username, $password) and !isset($_SESSION['id_login'])) {
  $url = 'login.php?p=2';
  if (isset($redirect)) {
    $url .= '&location=' . urlencode($redirect);
  }
  header("Location:" . $url);
  exit();
} elseif (isset($_SESSION['id_login'])) {
  // if login is successful and there is a redirect address, send the user directly there
  if ($redirect) {
    header("Location:" . $redirect);
  } else {
    header("Location:login.php?p=3");
  }
  exit();
}
