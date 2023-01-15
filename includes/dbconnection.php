<?php
// connect to the database
$conn = mysqli_connect("localhost", "root", "", "system_data");
// Check for connection errors
if (mysqli_connect_errno()) {
  die("Connection Fail" . mysqli_connect_error());
}
