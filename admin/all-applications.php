<?php
session_start();

// connects to db
include('../includes/dbconnection.php');
// check for privilege
include('includes/access.php');

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
        <div class="container-fluid px-4">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">All Applications</h1>
          </div>

          <!-- Content Row -->
          <div class="row" style="overflow: auto;">
            <!-- Input Mask start -->

            <!-- Formatter start -->
            <table class="table mb-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Course Applied</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Mobile Number</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php

              $ret = mysqli_query($conn, "SELECT tbladmapplications.CourseApplied,tbladmapplications.AdminStatus,tbladmapplications.ID AS apid, tbluser.FirstName,tbluser.LastName,tbluser.MobileNumber,tbluser.Email FROM  tbladmapplications INNER JOIN tbluser ON tbluser.ID=tbladmapplications.UserId WHERE tbluser.Privilege = 'student'");
              $cnt = 1;
              while ($row = mysqli_fetch_array($ret)) {

              ?>

                <tr>
                  <td><?php echo $cnt; ?></td>
                  <td><?php echo $row['CourseApplied']; ?></td>
                  <td><?php echo $row['FirstName']; ?></td>
                  <td><?php echo $row['LastName']; ?></td>
                  <td><?php echo $row['MobileNumber']; ?></td>
                  <td><?php echo $row['Email']; ?></td>
                  <?php if ($row['AdminStatus'] == "") { ?>

                    <td><?php echo "Not Updated Yet"; ?></td>
                  <?php }
                  if ($row['AdminStatus'] == "1") { ?>
                    <td><?php echo "Selected"; ?></td>
                  <?php }
                  if ($row['AdminStatus'] == "2") { ?>
                    <td><?php echo "Rejected"; ?></td>
                  <?php }
                  if ($row['AdminStatus'] == "3") { ?>
                    <td><?php echo "On hold"; ?></td>
                  <?php } ?>
                  <td><a href="view-appform.php?aticid=<?php echo $row['apid']; ?>" target="_blank">View Details</a></td>
                </tr>
              <?php
                $cnt = $cnt + 1;
              } ?>

            </table>
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