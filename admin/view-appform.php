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
  $cid = $_GET['aticid'];

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

    $admrmk = $_POST['AdminRemark'];
    $admsta = $_POST['status'];

    // Prepare the UPDATE statement
    $stmt = mysqli_prepare($conn, "UPDATE tbladmapplications SET AdminRemark = ?, AdminStatus = ? WHERE ID = ?");

    if ($stmt) {
      // Bind the parameters
      mysqli_stmt_bind_param($stmt, "ssi", $admrmk, $admsta, $cid);
      if (mysqli_stmt_execute($stmt)) {
        echo "<script>window.location.href ='dashboard.php'</script>";
      } else {
        echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        echo "<script>window.location.href ='dashboard.php'</script>";
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
        <div class="container-fluid px-4">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Application Form</h1>
          </div>

          <!-- Content Row -->
          <div class="row" style="overflow: auto;">
            <!-- Input Mask start -->

            <!-- Formatter start -->
            <?php
            $cid = $_GET['aticid'];
            $ret = mysqli_query($conn, "SELECT tbladmapplications.*,tbluser.FirstName,tbluser.LastName,tbluser.MobileNumber,tbluser.Email FROM tbladmapplications INNER JOIN tbluser ON tbluser.ID=tbladmapplications.UserId WHERE tbladmapplications.ID='$cid' AND tbluser.Privilege='student'");
            $cnt = 1;
            while ($row = mysqli_fetch_array($ret)) {

            ?>

              <table border="1" class="table table-bordered mg-b-0">
                <tr>
                  <th>Course Applied date</th>
                  <td><?php echo $row['CourseApplieddate']; ?></td>
                </tr>
                <tr>
                  <th>Course Applied</th>
                  <td><?php echo $row['CourseApplied']; ?></td>
                </tr>
                <tr>
                  <th>Student Fullname</th>
                  <td><?php echo $row['FirstName'] . " " . $row['LastName']; ?></td>
                </tr>

                <tr>
                  <th>Student Mob Number</th>
                  <td><?php echo $row['MobileNumber']; ?></td>
                </tr>

                <tr>
                  <th>Student Email</th>
                  <td><?php echo $row['Email']; ?></td>
                </tr>

                <tr>
                  <th>Student Photo</th>
                  <td><img src="../user/userimages/<?php echo $row['UserPic']; ?>" width="200" height="150"></td>
                </tr>
                <tr>
                  <th>Father Name</th>
                  <td><?php echo $row['FatherName']; ?></td>
                </tr>

                <tr>
                  <th>Mother Name</th>
                  <td><?php echo $row['MotherName']; ?></td>
                </tr>
                <tr>
                  <th>Date of Birth</th>
                  <td><?php echo $row['DOB']; ?></td>
                </tr>
                <tr>
                  <th>Nationality</th>
                  <td><?php echo $row['Nationality']; ?></td>
                </tr>
                <tr>
                  <th>Gender</th>
                  <td><?php echo $row['Gender']; ?></td>
                </tr>
                <tr>
                  <th>Correspondence Address</th>
                  <td><?php echo $row['CorrespondenceAdd']; ?></td>
                </tr>
                <tr>
                  <th>Permanent Address</th>
                  <td><?php echo $row['PermanentAdd']; ?></td>
                </tr>
                <tr>
                  <th>Proof of Residence</th>
                  <td><img src="../user/prof_of_res/<?php echo $row['ProfRes']; ?>" width="200" height="150"></td>
                </tr>
              </table>

              <table class="table mb-0">
                <tr>
                  <th>#</th>
                  <th>School</th>
                  <th>Year</th>
                </tr>


                <th>Junior Highschool</th>
                <td><?php echo $row['SecondaryBoard']; ?></td>
                <td><?php echo $row['SecondaryBoardyop']; ?></td>
                </tr>

                <tr>
                  <th>Senior Highschool</th>
                  <td><?php echo $row['SSecondaryBoard']; ?></td>
                  <td><?php echo $row['SSecondaryBoardyop']; ?></td>
                </tr>
                <tr>
                  <th>Graduation</th>
                  <td><?php echo $row['GraUni']; ?></td>
                  <td><?php echo $row['GraUniyop']; ?></td>
                </tr>

                <tr>
                  <th>Post Graduation</th>
                  <td><?php echo $row['PGUni']; ?></td>
                  <td><?php echo $row['PGUniyop']; ?></td>
                </tr>

              </table>

              <table class="table mb-0">

                <?php if ($row['AdminStatus'] == "" || $row['AdminStatus'] == "3") { ?>

                  <form name="submit" method="post" enctype="multipart/form-data" class="php-email-form">
                    <tr>
                      <th>Admin Remark:</th>
                      <td>
                        <?php
                        if ($row['AdminStatus'] == "3") {
                          $val = $row['AdminRemark'];
                        } else {
                          $val = "";
                        }
                        ?>
                        <textarea name="AdminRemark" rows="12" cols="14" class="form-control wd-450" maxlength="255" required="true"><?php echo $val; ?></textarea>
                      </td>
                    </tr>

                    <tr>
                      <th>Admin Status:</th>
                      <td>
                        <select name=" status" class="form-control wd-450" required="true">
                          <option value="1" selected="true">Selected</option>
                          <option value="2">Rejected</option>
                          <option value="3">On hold</option>
                        </select>
                      </td>
                    </tr>

                    <tr align="center" class="php-email-form">
                      <td colspan="2"><button type="submit" name="submit" class="btn btn-primary">Update</button></td>
                    </tr>
                  </form>
                <?php } else { ?>

                  <tr>
                    <th>Admin Remark</th>
                    <td><?php echo $row['AdminRemark']; ?></td>
                  </tr>


                  <tr>
                    <th>Admin Remark date</th>
                    <td><?php echo $row['AdminRemarkDate']; ?> </td>

                  <tr>
                    <th>Admin Status</th>
                    <td><?php
                        if ($row['AdminStatus'] == "1") {
                          echo "Selected";
                        }

                        if ($row['AdminStatus'] == "2") {
                          echo "Rejected";
                        }

                        if ($row['AdminStatus'] == "3") {
                          echo "On hold";
                        }; ?></td>
                  </tr>

                  </tr>

                <?php } ?>

              </table>

            <?php } ?>
            <div class="row" style="margin-top: 2%">
              <div class="col-xl-6 col-lg-12">
              </div>
            </div>
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