<?php
session_start();

// connect db
include('../includes/dbconnection.php');
// form filter
include('../includes/error/filter-input.php');

// Select the email for the admin with ID of 1 (Head Admin)
$query = "SELECT Email FROM tbluser WHERE Privilege='admin' AND ID = 1";
$result = mysqli_query($conn, $query);

// Fetch the result as an associative array
$admin = mysqli_fetch_assoc($result);

// Store the admin's email in a variable
$senderEmail = $admin['Email'];

// Use the PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require '../includes/email/vendor/autoload.php';

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
      $_POST[$key] = filterInput($conn, $value);
    }

    // for email and contact no. duplication alert
    $email = $_POST['email'];
    $contno = $_POST['contactno'];

    $_SESSION['fname'] = $_POST['firstname'];
    $_SESSION['lname'] = $_POST['lastname'];
    $_SESSION['contno'] = $contno;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = md5($_POST['password']);

    $stmt = mysqli_prepare($conn, "SELECT Email FROM tbluser WHERE (Email=? OR MobileNumber=?)");
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ss", $email, $contno);
      if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
          echo "<script>alert('This email or Contact Number already associated with another account');</script>";
        } else {
          // create a session for random otp code
          $otp = rand(100000, 999999);
          $_SESSION['otp'] = $otp;

          //Create an instance; passing `true` enables exceptions
          $mail = new PHPMailer(true);

          // Set up the SMTP server
          $mail->isSMTP();
          $mail->SMTPAuth = true;
          $mail->Host = "smtp.gmail.com";
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;

          // Authenticate with the SMTP server using the admin's email and password
          $mail->Username = $senderEmail;
          $mail->Password = "mdogemswrqerhfmb";

          // Set the sender and recipient of the email
          $mail->setFrom($senderEmail, 'OTP Verification');
          $mail->addAddress($email);

          // Set the subject and body of the email
          $mail->isHTML(true);
          $mail->Subject =
            "Your verify code";
          $mail->Body =
            "<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>";

          // Send the email and check if it was sent successfully
          if (!$mail->send()) {
?>
            <script>
              alert("<?php echo "Register Failed, Invalid Email " ?>");
              window.location.replace('signup.php');
            </script>
          <?php
          } else {
          ?>
            <script>
              window.location.replace('verify-otp.php');
            </script>
<?php
          }
        }
      }

      // close the statement
      mysqli_stmt_close($stmt);
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="signup" onSubmit="return checkpass();">
      <a href="../index.php"><img class="mb-3" src="../assets/img/logo-dark.png" alt="" width="72" height="72" /></a>
      <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

      <!-- name -->
      <div class="input-group mb-3">
        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" aria-label="firstname" maxlength="45" required />
        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" aria-label="lastname" maxlength="45" required />
      </div>

      <!-- contact no. -->
      <div class="input-group mb-3">
        <input type="tel" name="contactno" id="contactno" class="form-control" placeholder="Contact number - Format: 9876543210" aria-label="Contact number" pattern="[0-9]{10}" required />
      </div>

      <!-- email -->
      <div class="input-group mb-3">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" aria-label="Email" maxlength="40" required />
      </div>

      <!-- password -->
      <div class="input-group mb-3">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="Password" maxlength="60" required />
      </div>

      <!-- repeat password -->
      <div class="input-group mb-3">
        <input type="password" name="repeatpassword" id="repeatpassword" class="form-control" placeholder="Repeat password" aria-label="repeat-password" maxlength="60" required />
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