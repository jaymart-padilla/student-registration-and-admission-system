<?php

// connect db
include_once('/xampp/htdocs/projects/student_registration_system/includes/dbconnection.php');
// form filter
include('../error/filter-input.php');

// Use the PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Select the email for the admin with ID of 1 (Head Admin)
$query = "SELECT Email FROM tbluser WHERE Privilege='admin' AND ID = 1";
$result = mysqli_query($conn, $query);

// Fetch the result as an associative array
$admin = mysqli_fetch_assoc($result);

// Store the admin's email in a variable
$toEmail = $admin['Email'];

// XXS Protection
// filters all post data 
foreach ($_POST as $key => $value) {
  $_POST[$key] = filterInput($conn, $value);
}

// Get the filtered user's name, email, subject, and message from the form submission
$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];


//Load Composer's autoloader
require '/xampp/htdocs/projects/student_registration_system/includes/email/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// Set up the SMTP server
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

// Authenticate with the SMTP server using the admin's email and password
$mail->Username = $toEmail;
$mail->Password = "mdogemswrqerhfmb";

// Set the sender and recipient of the email
$mail->setFrom($email, $name);
$mail->addAddress($toEmail);

// Set the subject and body of the email
$mail->Subject = $subject;
$mail->Body = $message;

// Send the email and check if it was sent successfully
if ($mail->send()) {
  echo "<script>alert('Email sent successfully!')</script>";
} else {
  echo "<script>alert('Email did not sent!')</script>";
}

header("Location: http://localhost/projects/student_registration_system/");
