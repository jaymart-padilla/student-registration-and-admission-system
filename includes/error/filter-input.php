<?php

function filterInput($con, $data)
{
  // Remove whitespace from the beginning and end of the input
  $data = trim($data);
  // Escape special characters for use in a MySQL statement
  $data = mysqli_real_escape_string($con, $data);
  // Remove any backslashes from the input
  $data = stripslashes($data);
  // Convert any special characters to their HTML entities
  $data = htmlspecialchars($data);

  return $data;
}
