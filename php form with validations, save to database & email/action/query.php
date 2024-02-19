<?php
$response = "";
$status = "";
$errors = false;

// Validate and sanitize input
$name     = htmlspecialchars($_POST['name']);
$email    = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone    = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
$job      = htmlspecialchars($_POST['job']);
$state    = htmlspecialchars($_POST['state']);
$city     = htmlspecialchars($_POST['city']);
$services = implode(', ', $_POST['services'] ); //join checkboxes as string
$services = htmlspecialchars($services);

// if job is yes
if ( $job == 'YES' ) {
  // Redirect to careers page
  header("Location: https://link4solution.com/");
  exit();
}

// Validate name (alphabets only)
if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
  $response = "Invalid name. Please enter alphabets only. ";
  $errors = true;
}

// Validate phone number (10 digits only)
if (!preg_match("/^\d{10}$/", $phone)) {
  $response = "Invalid phone number. Please enter 10 digits only. ";
  $errors = true;
}

// Validate fields are not empty
if ( empty($job) || empty($state) || empty($city) ) {
  $response = "Required fields can not be empty. ";
  $errors = true;
}

// Validate at least one service is checked
if ( empty($services) ) {
  $response = "Please select at least one service. ";
  $errors = true;
}

// Check honeypot field
if (!empty($_POST['honeypot'])) {
  // Handle as spam, redirect or show an error message
  $response = "Sorry, an error occurred. ";
  $errors = true;
}

// Validate captcha
session_start();
if ($_POST['captcha'] !== $_SESSION['captcha']) {
  // Handle invalid captcha, redirect or show an error message
  $response = "Invalid captcha, please try again. ";
  $errors = true;
}

// IF ANY ERROR
if( $errors == true ){

  // Redirect & show response
  $status = "ERROR";
  header("Location: response.php?status=".$status."&response=".$response);
  exit();

} else {

  // Database connection
  $servername = "localhost";
  $username = "your_username";
  $password = "your_password";
  $database = "your_database";
  $mysqli = new mysqli($servername, $username, $password, $database);
  if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
  }
  // to supports international chars
  $mysqli->set_charset("utf8");

  // Insert data into database
  $stmt = $mysqli->prepare("INSERT INTO `contacts` (`name`, `email`, `phone`, `job`, `state`, `city`, `services`) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $name, $email, $phone, $job, $state, $city, $services);
  $stmt->execute();
  $stmt->close();
  $response = "Query Saved to Database. ";


  try {
    // Send email to user
    $to = $email;
    $subject = "Thank you for contacting us";
    $message = "Hello $name,\n\n Thank you for contacting us. We will get back to you as soon as possible. \n\n Regards, \n Link4Solution";
    $headers = "From: admin@example.com";
    if (!mail($to, $subject, $message, $headers)) {
      throw new Exception("Failed to send email to user.");
    }

    // Send email to admin
    $to_admin = "admin@example.com";
    $subject_admin = "New Contact Form Submission";
    $message_admin = "Name: $name\nEmail: $email\nPhone: $phone\nServices: " . implode(', ', $services);
    $headers_admin = "From: $email";
    if (!mail($to_admin, $subject_admin, $message_admin, $headers_admin)) {
      throw new Exception("Failed to send email to admin.");
    }

    // sent ok msg
    $response .= " <br> Emails Sent Successfully. ";

  } catch (Exception $e) {
    // Handle email sending errors
    // exit("An error occurred while sending emails: " . $e->getMessage());
    $response .= " <br> Emails Failed. " . $e->getMessage();
  }

  // Redirect or show response
  $status = "OK";
  header("Location: response.php?status=".$status."&response=".$response);
  exit();

}
