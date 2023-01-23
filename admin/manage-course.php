<?php
session_start();

// connects to db
include('../includes/dbconnection.php');
// checks for privilege
include('includes/access.php');

//code for deletion
if (isset($_GET['delid'])) {
  $rowid = $_GET['delid'];
  // delete data from db
  $query = mysqli_query($conn, "DELETE FROM tblcourse WHERE ID='$rowid'");
  echo "<script>alert('Course deleted successfully');</script>";
  echo "<script>window.location.href='manage-course.php'</script>";
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
        <div class="container-fluid px-4">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Courses</h1>
          </div>

          <!-- Content Row -->
          <div class="row" style="overflow: auto;">
            <!-- Input Mask start -->

            <!-- Formatter start -->
            <table class="table mb-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Course Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
              $ret = mysqli_query($conn, "SELECT * FROM tblcourse");
              $cnt = 1;
              while ($row = mysqli_fetch_array($ret)) {
              ?>
                <tr>
                  <td><?php echo $cnt; ?></td>

                  <td><?php echo $row['CourseName']; ?></td>

                  <td><a style="text-decoration: none;" class="text-warning" href="edit-course.php?editid=<?php echo $row['ID']; ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                      </svg>
                    </a> <strong class="mx-1">|</strong>
                    <a style="text-decoration: none;" class="text-danger" href="manage-course.php?delid=<?php echo $row['ID']; ?>" onclick="return confirm('Do you really want to delete this course?');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2-fill" viewBox="0 0 16 16">
                        <path d="M2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225zm9.89-.69C10.966 2.214 9.578 2 8 2c-1.58 0-2.968.215-3.926.534-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466-.18-.14-.498-.307-.975-.466z" />
                      </svg></a>
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