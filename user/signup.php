<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (isset($_POST['submit'])) {
  $fname = $_POST['firstname'];
  $lname = $_POST['lastname'];
  $contno = $_POST['contactno'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $ret = mysqli_query($con, "select Email from tbluser where Email='$email' || MobileNumber='$contno'");
  $result = mysqli_fetch_array($ret);
  if ($result > 0) {
    echo "<script>alert('This email or Contact Number already associated with another account');</script>";
  } else {
    $query = mysqli_query($con, "insert into tbluser(FirstName, LastName,MobileNumber, Email,  Password) value('$fname', '$lname','$contno', '$email', '$password' )");
    if ($query) {
      echo "<script>alert('You have successfully registered');</script>";
      header("location: login.php");
    } else {
      echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="description" content="PSU-ACC | Student Registration System | Sign up page" />
  <meta name="author" content="Jaymart Padilla" />
  <title>PSU-ACC · Sign up</title>

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

  <!-- if repeat password didn't match -->
  <script type="text/javascript">
    function checkpass() {
      if (document.signup.password.value != document.signup.repeatpassword.value) {
        alert('Password and Repeat Password field does not match');
        document.signup.repeatpassword.focus();
        return false;
      }
      return true;
    }
  </script>
</head>

<body class="text-center">
  <main class="form-signin w-100 m-auto">
    <form method="post" name="signup" onSubmit="return checkpass();">
      <a href="../index.php"><img class="mb-3" src="../assets/img/Pangasinan_State_University_logo.png" alt="" width="72" height="72" /></a>
      <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

      <!-- name -->
      <div class="input-group mb-3">
        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" aria-label="firstname" required />
        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" aria-label="lastname" required />
      </div>

      <!-- contact no. -->
      <div class="input-group mb-3">
        <input type="tel" name="contactno" id="contactno" class="form-control" placeholder="Contact number" aria-label="Contact number" maxlength="10" required />
      </div>

      <!-- email -->
      <div class="input-group mb-3">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" aria-label="Email" required />
      </div>

      <!-- password -->
      <div class="input-group mb-3">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="Password" required />
      </div>

      <!-- repeat password -->
      <div class="input-group mb-3">
        <input type="password" name="repeatpassword" id="repeatpassword" class="form-control" placeholder="Repeat password" aria-label="repeat-password" required />
      </div>

      <!-- submit -->
      <button type="submit" name="submit" class="w-100 btn btn-lg" id="btn-get-started">
        Sign up
      </button>

      <!-- other options -->
      <a href="login.php">
        <button class="w-100" id="secondary-btn" type="button">Have an account?</button>
      </a>
      <a href="../admin/login.php" class="text-center d-block mt-2">Admin?</a>
      <!-- end other options -->
    </form>
  </main>
</body>

</html>