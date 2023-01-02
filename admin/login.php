<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');

if (isset($_POST['login'])) {
  $adminuser = $_POST['username'];
  $password = md5($_POST['password']);
  $query = mysqli_query($con, "select ID from tbladmin where  AdminuserName='$adminuser' && Password='$password' ");
  $ret = mysqli_fetch_array($query);
  if ($ret > 0) {
    $_SESSION['aid'] = $ret['ID'];
    echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
  } else {
    echo "<script>alert('Invalid Details');</script>";
    echo "<script type='text/javascript'> document.location ='login.php'; </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="description" content="PSU-ACC | Student Registration System | Admin login page" />
  <meta name="author" content="Jaymart Padilla" />
  <title>PSU-ACC · Admin login</title>

  <!-- title icon -->
  <link rel="icon" href="/assets/img/Pangasinan_State_University_logo.png" />

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

<body class="text-center">
  <main class="form-signin w-100 m-auto">
    <form action="" name="login" method="post">
      <a href="../index.php"><img class="mb-3" src="../assets/img/Pangasinan_State_University_logo.png" alt="" width="72" height="72" /></a>
      <h1 class="h3 mb-3 fw-normal">Admin</h1>

      <!-- username -->
      <div class="input-group mb-3">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" aria-label="username" required />
      </div>

      <!-- password -->
      <div class="input-group mb-3">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="Password" required />
      </div>

      <!-- submit -->
      <button type="submit" name="login" class="w-100 btn btn-lg" id="btn-get-started">
        Login
      </button>

      <!-- other options -->
      <div class="d-flex justify-content-between px-1">
        <a href="forget-password.php" class="text-center mt-2 d-block small">Forgot password?</a>
        <a href="../user/signup.php" class="text-center mt-2 d-block small">Register as a user</a>
      </div>
      <!-- end other options -->
    </form>
  </main>
  <!-- BEGIN VENDOR JS-->
  <script src="/../app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
</body>

</html>