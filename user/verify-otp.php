<?php
session_start();

// connects to db
include('../includes/dbconnection.php');
// form filter
include('../includes/error/filter-input.php');

if (isset($_POST['submit'])) {
  // XXS Protection
  // filters all session data 
  foreach ($_SESSION as $key => $value) {
    $_SESSION[$key] = filterInput($conn, $value);
  }

  // collect session data
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $contno = $_SESSION['contno'];
  $email = $_SESSION['email'];
  $password = $_SESSION['password'];
  $privilege = 'student';

  // OTP's to compare
  $otp = $_SESSION['otp'];
  $otp_code = $_POST['otp_code'];

  // if otp did match -> save to db
  if ($otp != $otp_code) {
?>
    <script>
      alert("Invalid OTP code");
      window.location.replace("verify-otp.php");
    </script>
    <?php
  } else {
    // prepare the INSERT statement
    $stmt = mysqli_prepare($conn, "INSERT INTO tbluser(FirstName, LastName, MobileNumber, Email, Password, Privilege) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
      // bind params
      mysqli_stmt_bind_param($stmt, "ssssss", $fname, $lname, $contno, $email, $password, $privilege);

      if (mysqli_stmt_execute($stmt)) {
    ?>
        <script>
          alert("Verfiy account done, you may sign in now");
          window.location.replace("login.php");
        </script>
    <?php
      } else {
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
      }

      // close the statement
      mysqli_stmt_close($stmt);
    }
    ?>
<?php
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="signup" onSubmit="return checkpass();">
      <a href="../index.php"><img class="mb-3" src="../assets/img/logo-dark.png" alt="" width="72" height="72" /></a>
      <h1 class="h3 mb-3 fw-normal">Verify Your Email</h1>

      <!-- enter otp -->
      <div class="mb-3">
        <label for="otp" class="form-label fw-bold">Enter OTP: </label>
        <input type="otp" class="form-control" id="otp" name="otp_code" />
      </div>

      <!-- verify -->
      <button type="submit" name="submit" class="w-100 btn btn-lg" id="btn-get-started">
        Submit
      </button>
    </form>
  </main>
</body>

</html>