<?php
session_start();

include('../includes/dbconnection.php');

$formError = "";

if (isset($_POST['submit'])) {
  // check for empty values
  foreach ($_POST as $field => $value) {
    if (empty($value) && $field != 'submit') {
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

    $mobno = $_POST['mobilenumber'];
    $email = $_POST['email'];

    // check for match
    $query = mysqli_query($conn, "SELECT ID FROM tbluser WHERE Privilege='admin' AND Email='$email' AND MobileNumber ='$mobno'");
    $ret = mysqli_fetch_array($query);
    if ($ret > 0) {
      $_SESSION['mobilenumber'] = $mobno;
      $_SESSION['email'] = $email;

      echo "<script type='text/javascript'> document.location ='reset-password.php'; </script>";
    } else {
      echo "<script>alert('Invalid Details. Please try again.');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="description" content="PSU-ACC | Student Registration System | Admin - Recover password page" />
  <meta name="author" content="Jaymart Padilla" />
  <title>PSU-ACC · Admin | Recover password</title>

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

<body>
  <main class="form-signin w-100 m-auto">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="text-center">
        <a href="../index.php"><img class="mb-3" src="../assets/img/logo-dark.png" alt="" width="72" height="72" /></a>
        <h1 class="h3 mb-3 fw-normal">Admin Recover Password</h1>
      </div>

      <!-- email -->
      <div class="input-group mb-3">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email address" aria-label="email" required />
      </div>

      <!-- tel -->
      <div class="input-group mb-3">
        <input type="tel" name="mobilenumber" id="mobilenumber" class="form-control" placeholder="Contact number" aria-label="contact number" required />
      </div>

      <?php
      if (!empty($formError)) {
        echo "
                              <p class='text-danger text-center m-0 p-0'>*$formError</p>
                              ";
      }
      ?>

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