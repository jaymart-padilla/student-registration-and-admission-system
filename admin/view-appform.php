<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['aid'] == 0)) {
  header('location:logout.php');
} else {

  if (isset($_POST['submit'])) {
    $cid = $_GET['aticid'];
    $admrmk = $_POST['AdminRemark'];
    $admsta = $_POST['status'];
    $toemail = $_POST['useremail'];
    $query = mysqli_query($con, "update  tbladmapplications set AdminRemark='$admrmk',AdminStatus='$admsta' where ID='$cid'");
    if ($query) {
      $subj = "Admission Application Status";
      $heade .= "MIME-Version: 1.0" . "\r\n";
      $heade .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $heade .= 'From:CAMS<noreply@yourdomain.com>' . "\r\n";    // Put your sender email here
      $msgec .= "<html></body><div><div>Hello,</div></br></br>";
      $msgec .= "<div style='padding-top:8px;'>Your Admission application has been $admsta ) </br>
<strong>Admin Remark: </strong> $admrmk </div><div></div></body></html>";
      mail($toemail, $subj, $msgec, $heade);
      echo "<script>alert('Admin Remark and Status has been updated.');</script>";
      echo "<script>window.location.href ='pending-application.php'</script>";
    } else {
      echo "<script>alert('Something Went Wrong. Please try again.');</script>";
      echo "<script>window.location.href ='pending-application.php'</script>";
    }
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet" />
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
              <h1 class="h3 mb-0 text-gray-800">View Application Form</h1>
            </div>

            <!-- Content Row -->
            <div class="row" style="overflow: auto;">
              <!-- Input Mask start -->

              <!-- Formatter start -->

              <?php
              $cid = $_GET['aticid'];
              $ret = mysqli_query($con, "select tbladmapplications.*,tbluser.FirstName,tbluser.LastName,tbluser.MobileNumber,tbluser.Email from  tbladmapplications inner join tbluser on tbluser.ID=tbladmapplications.UserId where tbladmapplications.ID='$cid'");
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
                    <th>Student Picture</th>
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
                    <th>DOB</th>
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
                    <th>Board / University</th>
                    <th>Year</th>
                  </tr>


                  <th>10th(Secondary)</th>
                  <td><?php echo $row['SecondaryBoard']; ?></td>
                  <td><?php echo $row['SecondaryBoardyop']; ?></td>
                  </tr>

                  <tr>
                    <th>12th(Senior Secondary)</th>
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

                  <?php if ($row['AdminRemark'] == "") { ?>


                    <form name="submit" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="useremail" value="<?php echo $row['Email']; ?>">
                      <tr>
                        <th>Admin Remark :</th>
                        <td>
                          <textarea name="AdminRemark" placeholder="" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
                        </td>
                      </tr>

                      <tr>
                        <th>Admin Status :</th>
                        <td>
                          <select name="status" class="form-control wd-450" required="true">
                            <option value="1" selected="true">Selected</option>
                            <option value="2">Rejected</option>
                          </select>
                        </td>
                      </tr>

                      <tr align="center">
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
<?php  } ?>