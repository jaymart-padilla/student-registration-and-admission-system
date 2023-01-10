<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['uid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $eid = $_GET['editid'];
    $uid = $_SESSION['uid'];
    $coursename = $_POST['coursename'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $dob = $_POST['dob'];
    $nationality = $_POST['nationality'];
    $gender = $_POST['gender'];
    $coradd = $_POST['coradd'];
    $peradd = $_POST['peradd'];
    $secboard = $_POST['10thboard'];
    $secyop = $_POST['10thpyear'];
    $ssecboard = $_POST['12thboard'];
    $ssecyop = $_POST['12thpyear'];
    $grauni = $_POST['graduation'];
    $grayop = $_POST['graduationpyeaer'];
    $pguni = $_POST['postgraduation'];
    $pgyop = $_POST['pgpyear'];

    $query = mysqli_query($con, "update tbladmapplications set CourseApplied='$coursename',FatherName='$fathername',MotherName='$mothername',DOB='$dob',Nationality='$nationality',Gender='$gender',CorrespondenceAdd='$coradd',PermanentAdd='$peradd',SecondaryBoard='$secboard',SecondaryBoardyop='$secyop',SSecondaryBoard='$ssecboard',SSecondaryBoardyop='$ssecyop',GraUni='$grauni',GraUniyop='$grayop',PGUni='$pguni',PGUniyop='$pgyop' where ID='$eid' && UserId='$uid'");

    if ($query) {
      echo '<script>alert("Data has been updated successfully.")</script>';
    } else {
      echo '<script>alert("Something went wrong. Please try again.")</script>';
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
    <link rel="icon" href="../assets/img/Pangasinan_State_University_logo.png" type="image/png" />

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
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Content Row -->
            <!-- Edit Applicaton Form Contents  -->
            <div class="row">
              <form name="submit" method="post" enctype="multipart/form-data" class="php-email-form"> <?php
                                                                                                      $eid = $_GET['editid'];
                                                                                                      $uid = $_SESSION['uid'];
                                                                                                      $ret = mysqli_query($con, "select * from tbladmapplications where ID='$eid' && UserId='$uid'");
                                                                                                      $cnt = 1;
                                                                                                      while ($row = mysqli_fetch_array($ret)) {

                                                                                                      ?>
                  <section class="formatter" id="formatter">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title">Update Addimission Form</h4>
                          </div>
                          <div class="card-content">
                            <div class="card-body">


                              <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                  <fieldset>
                                    <h5>Course Applied </h5>
                                    <div class="form-group">
                                      <select name='coursename' id="coursename" class="form-control white_bg">
                                        <option value="<?php echo $row['CourseApplied']; ?>"><?php echo $row['CourseApplied']; ?></option>
                                        <?php $query = mysqli_query($con, "select * from tblcourse");
                                                                                                        while ($row1 = mysqli_fetch_array($query)) {
                                        ?>
                                          <option value="<?php echo $row1['CourseName']; ?>"><?php echo $row1['CourseName']; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </fieldset>

                                </div>

                                <div class="col-xl-6 col-lg-12">
                                  <fieldset>
                                    <h5>Student Photo</h5>
                                    <div class="form-group">
                                      <img src="userimages/<?php echo $row['UserPic']; ?>" width="100" height="100"> <a href="change-image.php?editid=<?php echo $row['ID']; ?>"> &nbsp; Edit Image</a>
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                  <fieldset>
                                    <h5>Father's Name </h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="fathername" name="fathername" type="text" required='true' value="<?php echo $row['FatherName']; ?>">
                                    </div>
                                  </fieldset>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                  <fieldset>
                                    <h5>Mother's Name </h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="mothername" name="mothername" type="text" required='true' value="<?php echo $row['MotherName']; ?>">
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xl-4 col-lg-12">
                                  <fieldset>
                                    <h5>Date of Birth</h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="dob" name="dob" type="date" required='true' value="<?php echo $row['DOB']; ?>">
                                      <small class="text-muted">Must be in this format (MM-DD-YYYY)</small>
                                    </div>

                                  </fieldset>
                                </div>
                                <div class="col-xl-4 col-lg-12">
                                  <fieldset>
                                    <h5>Nationality </h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="nationality" name="nationality" type="text" required='true' value="<?php echo $row['Nationality']; ?>">
                                    </div>

                                  </fieldset>
                                </div>
                                <div class="col-xl-4 col-lg-12">
                                  <fieldset>
                                    <h5>Gender </h5>
                                    <div class="form-group">

                                      <select class="form-control white_bg" id="gender" name="gender" required>
                                        <option value="<?php echo $row['Gender']; ?>"><?php echo $row['Gender']; ?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                      </select>
                                    </div>
                                  </fieldset>
                                </div>

                              </div>
                              <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                  <fieldset>
                                    <h5>Correspondence Address </h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="coradd" name="coradd" type="text" required='true' value="<?php echo $row['CorrespondenceAdd']; ?>">
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                  <fieldset>
                                    <h5>Permanent Address </h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="peradd" name="peradd" type="text" required='true' value="<?php echo $row['PermanentAdd']; ?>">
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                  <fieldset>
                                    <h5>Proof of Residence</h5>
                                    <div class="form-group">
                                      <img src="prof_of_res/<?php echo $row['ProfRes']; ?>" width="100" height="100"> <a href="change-profres.php?editid=<?php echo $row['ID']; ?>"> &nbsp; Edit Image</a>
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                              <div class="row" style="margin-top: 2%">
                                <div class="col-xl-12 col-lg-12">
                                  <h4 class="card-title">Education Qualification</h4>
                                  <hr />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                  <table class="table mb-0">
                                    <tr>
                                      <th>#</th>
                                      <th>School</th>
                                      <th>Year</th>
                                    </tr>
                                    <tr>
                                      <th>10th(Secondary)</th>
                                      <td> <input class="form-control white_bg" id="10thboard" name="10thboard" placeholder="Board / University" type="text" required='true' value="<?php echo $row['SecondaryBoard']; ?>"></td>
                                      <td> <input class="form-control white_bg" id="10thpyeaer" name="10thpyear" placeholder="Year" type="number" required='true' value="<?php echo $row['SecondaryBoardyop']; ?>"></td>
                                    </tr>
                                    <tr>
                                      <th>12th(Senior Secondary)</th>
                                      <td> <input class="form-control white_bg" id="12thboard" name="12thboard" placeholder="Board / University" type="text" required='true' value="<?php echo $row['SSecondaryBoard']; ?>"></td>
                                      <td> <input class="form-control white_bg" id="12thboard" name="12thpyear" placeholder="Year" type="number" required='true' value="<?php echo $row['SSecondaryBoardyop']; ?>"></td>
                                    </tr>
                                    <tr>
                                      <th>Graduation</th>
                                      <td> <input class="form-control white_bg" id="graduation" name="graduation" placeholder="Board / University" type="text" value="<?php echo $row['GraUni']; ?>"></td>
                                      <td> <input class="form-control white_bg" id="graduationpyeaer" name="graduationpyeaer" placeholder="Year" type="number" value="<?php echo $row['GraUniyop']; ?>"></td>
                                    </tr>
                                    <tr>
                                      <th>Post Graduation</th>
                                      <td> <input class="form-control white_bg" id="postgraduation" name="postgraduation" placeholder="Board / University" type="text" value="<?php echo $row['PGUni']; ?>"></td>
                                      <td> <input class="form-control white_bg" id="pgpyeaer" name="pgpyear" placeholder="Year" type="number" value="<?php echo $row['PGUniyop']; ?>"></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              </hr>
                            <?php
                                                                                                        $cnt = $cnt + 1;
                                                                                                      } ?>
                            <div class="row" style="margin-top: 2%">
                              <div class="col-xl-6 col-lg-12">
                                <button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Update</button>
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
<?php } ?>