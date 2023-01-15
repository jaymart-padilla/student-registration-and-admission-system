<?php
// connects to db
include('../includes/dbconnection.php');

// check for privilege
if (isset($_SESSION['id'])) {
  $userId = $_SESSION['id'];
  $query = mysqli_query($conn, "SELECT Privilege FROM tbluser WHERE ID='$userId'");
  if ($query) {
    $row = mysqli_fetch_assoc($query);
    $privilege = $row['Privilege'];
    if (!$privilege == 'student') {
      // logs the unauthorized user out (invalid credentials)
      echo "Error: You do not have the necessary privileges to access this page.";
      header('location:logout.php');
    }
  } else {
    echo "Error: Could not retrieve user data from the database. Please try again later.";
  }
} else {
  // logs the unauthorized user out (no id saved from session)
  header('location:logout.php');
}
