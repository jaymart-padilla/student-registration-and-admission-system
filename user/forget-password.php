<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');

if (isset($_POST['submit'])) {
  $mobno = $_POST['mobilenumber'];
  $email = $_POST['email'];

  $query = mysqli_query($con, "select ID from tbluser where  Email='$email' and  MobileNumber ='$mobno' ");
  $ret = mysqli_fetch_array($query);
  if ($ret > 0) {
    $_SESSION['mobilenumber'] = $mobno;
    $_SESSION['email'] = $email;
    echo "<script type='text/javascript'> document.location ='reset-password.php'; </script>";
  } else {
    echo "<script>alert('Invalid Details. Please try again.');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="description" content="PSU-ACC | Student Registration System | Recover password page" />
  <meta name="author" content="Jaymart Padilla" />
  <title>PSU-ACC · Recover password</title>

  <!-- title icon -->
  <link rel="icon" href="../assets/img/Pangasinan_State_University_logo.png" />

  <!-- bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <!-- Custom styles -->

  <link href="../assets/css/style.css" rel="stylesheet" />

  <style>
    body {
      height: 100vh;
      display: flex;
      align-items: center;
    }

    .form-signin {
      max-width: 340px;
      padding: 15px;
    }
  </style>
</head>

<body>
  <main class="form-signin w-100 m-auto">
    <form name="resetpassword" method="post" onsubmit="return checkpass();">
      <div class="text-center">
        <a href="../index.php"><img class="mb-3" src="../assets/img/Pangasinan_State_University_logo.png" alt="" width="72" height="72" /></a>
        <h1 class="h3 mb-3 fw-normal">PSU-ACC Recover Password</h1>
      </div>

      <!-- email -->
      <div class="input-group mb-3">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email address" aria-label="email" required />
      </div>

      <!-- tel -->
      <div class="input-group mb-3">
        <input type="tel" name="mobilenumber" id="mobilenumber" class="form-control" placeholder="Contact number" aria-label="contact number" required />
      </div>

      <!-- submit -->
      <button type="submit" name="submit" class="w-100 btn btn-lg" id="btn-get-started">
        Continue
      </button>
    </form>
    <!-- login option -->
    <a href="login.php">
      <button id="secondary-btn" class="w-100">Login instead?</button>
    </a>
  </main>
</body>

</html>