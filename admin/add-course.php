<?php
session_start();

// connects to db
include('../includes/dbconnection.php');
// check for privilege
include('includes/access.php');
// form filter
include('../includes/error/filter-input.php');

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

    $coursename = $_POST['coursename'];

    // Prepare the SQL statement
    $stmt = mysqli_prepare(
      $conn,
      "INSERT INTO tblcourse(CourseName) VALUE(?)"
    );
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "s", $coursename);

      if (mysqli_stmt_execute($stmt)) {
        $msg = "Course has been added.";
        echo "<script>window.location.href ='manage-course.php'</script>";
      } else {
        echo '<script>alert("Something Went Wrong. Please try again.")</script>';
      }

      mysqli_stmt_close($stmt);
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="PSU-ACC | Student Registration System" />
  <meta name="author" content="Jaymart Padila" />
  <title>PSU-ACC · Student Registration System</title>

  <!-- title icon -->
  <link rel="icon" href="../assets/img/logo-light.png" type="image/png" />

  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <!-- Custom styles for this template-->
  <link href="../assets/css/dashboard-styles-min.css" rel="stylesheet" />
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include_once('includes/sidebar.php'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php include_once('includes/header.php'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Course</h1>
          </div>

          <!-- Content Row -->
          <div class="row" style="overflow: auto;">
            <!-- Input Mask start -->

            <!-- Formatter start -->

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="course" method="post" class="php-email-form">
              <section class="formatter" id="formatter">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Course in College</h4>
                        <?php
                        if (!empty($formError)) {
                          echo "
                              <p class='text-danger m-0 p-0'>*$formError</p>
                              ";
                        }
                        ?>
                      </div>
                      <div class="card-content">
                        <div class="card-body">


                          <div class="row">
                            <div class="col-xl-6 col-lg-12">
                              <fieldset>
                                <h6>Course Name</h6>
                                <div class="form-group">
                                  <input class="form-control white_bg" id="coursename" type="text" name="coursename" maxlength="90" required>
                                </div>
                              </fieldset>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xl-6 col-lg-12">
                              <button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">ADD</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- Formatter end -->
            </form>

          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include_once('includes/footer.php'); ?>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php include_once('includes/logout-modal.php'); ?>

  <!-- Bootstrap core JavaScript-->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../assets/js/demo/chart-area-demo.js"></script>

</body>

</html>