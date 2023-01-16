<?php
session_start();

include('../includes/dbconnection.php');

$formError = "";

if (isset($_POST['login'])) {
  // check for empty values
  foreach ($_POST as $field => $value) {
    if (empty($value) && $field != 'login') {
      $formError = $field . " is required. ";
    }
  }

  // if no empty values
  if (empty($formError)) {
    // XXS Protection
    // filters all post data 
    foreach ($_POST as $key => $value) {
      $_POST[$key] = htmlspecialchars($value);
    }

    $adminEmail = $_POST['email'];
    $password = md5($_POST['password']);

    // check if match
    $query = mysqli_query($conn, "SELECT ID FROM tbluser WHERE Email='$adminEmail' AND Password='$password'");
    $ret = mysqli_fetch_array($query);
    if ($ret > 0) {
      $_SESSION['aid'] = $ret['ID'];
      $_SESSION['id'] = $ret['ID'];
      echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    } else {
      echo "<script>alert('Invalid Details');</script>";
      echo "<script type='text/javascript'> document.location ='login.php'; </script>";
    }
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
  <link rel="icon" href="../assets/img/logo-light.png" />

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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="login" method="post">
      <a href="../index.php"><img class="mb-3" src="../assets/img/logo-dark.png" alt="" width="72" height="72" /></a>
      <h1 class="h3 mb-3 fw-normal">Admin</h1>

      <!-- email -->
      <div class="input-group mb-3">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" aria-label="email" required />
      </div>

      <!-- password -->
      <div class="input-group mb-3">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="Password" required />
      </div>

      <?php
      if (!empty($formError)) {
        echo "
                              <p class='text-danger text-center m-0 p-0'>*$formError</p>
                              ";
      }
      ?>

      <!-- submit -->
      <button type="submit" name="login" class="w-100 btn btn-lg" id="btn-get-started">
        Login
      </button>

      <!-- other options -->
      <div class="d-flex justify-content-between px-1">
        <a href="forgot-password.php" class="text-center mt-2 d-block small">Forgot password?</a>
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