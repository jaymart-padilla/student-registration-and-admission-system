<?php

// connect to the db
include_once('includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="description" content="PSU-ACC | Student Registration System" />
  <meta name="author" content="Jaymart Padila" />
  <title>PSU-ACC · Student Registration System</title>

  <!-- title icon -->
  <link rel="icon" href="assets/img/logo-light.png" type="image/png" />

  <!-- bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <!-- Custom styles -->
  <link href="assets/css/style.css" rel="stylesheet" />
</head>


<?php
// start the session
session_start();
// Connects to the database
include('includes/dbconnection.php');

// checks for id
if (isset($_SESSION['id'])) {
  $userId = $_SESSION['id'];
  $query = mysqli_query($conn, "SELECT Privilege FROM tbluser WHERE ID='$userId'");
  if ($query) {
    $row = mysqli_fetch_assoc($query);
    $privilege = $row['Privilege'];
    if ($privilege == 'admin') {
      // load admin's dashboard if logged in as an admin
      header('location: admin/dashboard.php');
    } elseif ($privilege == 'student') {
      // load user's dashboard if logged in as a user
      header('location: user/dashboard.php');
    } else {
      echo "Error: You do not have the necessary privileges to access this page.";
    }
  } else {
    echo "Error: Could not retrieve user data from the database. Please try again later.";
  }
} else {
  // load homepage if neither logged in as an admin or a user (no id saved from session)
  require_once('homepage.php');
}
?>

</html>