<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
error_reporting(0);

if (isset($_POST['submit'])) {
  $mobno = $_SESSION['mobilenumber'];
  $email = $_SESSION['email'];
  $newpassword = md5($_POST['newpassword']);
  $query = mysqli_query($con, "update tbluser set Password ='$newpassword' where  Email='$email' && MobileNumber = '$mobno'");

  if ($query) {
    echo "<script>alert('Password successfully changed');</script>";
    session_destroy();
    header('location: login.php');
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="description" content="PSU-ACC | Student Registration System | Reset password page" />
  <meta name="author" content="Jaymart Padilla" />
  <title>PSU-ACC · Reset password</title>

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

  <!-- if repeat password didn't matched -->
  <script type="text/javascript">
    function checkpass() {
      if (
        document.resetpassword.newpassword.value !=
        document.resetpassword.confirmpassword.value
      ) {
        alert("New Password and Confirm Password field does not match");
        document.resetpassword.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
  <main class="form-signin w-100 m-auto">
    <form name="resetpassword" method="post" onsubmit="return checkpass();">
      <div class="text-center">
        <a href="../index.php"><img class="mb-3" src="../assets/img/Pangasinan_State_University_logo.png" alt="" width="72" height="72" /></a>
        <h1 class="h3 mb-3 fw-normal">PSU-ACC Reset Password</h1>
      </div>

      <!-- new password -->
      <div class="input-group mb-3">
        <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="New password" aria-label="new password" required />
      </div>

      <!-- confirm new password -->
      <div class="input-group mb-3">
        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirm new password" aria-label="confirm new password" required />
      </div>

      <!-- submit -->
      <button type="submit" name="submit" class="w-100 btn btn-lg" id="btn-get-started">
        Reset
      </button>

    </form>
    <!-- other option -->
    <a href="login.php">
      <button id="secondary-btn" class="w-100">Login instead?</button>
    </a>
    <a href="signup.php" class="d-block text-center mt-2">Sign up for a new account?</a>
  </main>
</body>

</html>