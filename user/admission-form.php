<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['uid'] == 0)) {
  header('location:logout.php');
} else {

  // Coding for form Submission 	
  if (isset($_POST['submit'])) {
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
    $upic = $_FILES["userpic"]["name"];
    $profres = $_FILES["profres"]["name"];

    $extension = substr($upic, strlen($upic) - 4, strlen($upic));
    $pextension = substr($profres, strlen($profres) - 4, strlen($profres));
    // allowed extensions
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
    // Validation for allowed extensions .in_array() function searches an array for a specific value.
    if (!in_array($extension, $allowed_extensions) || !in_array($pextension, $allowed_extensions)) {
      echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
      // rename user pic
      $userpic = md5($upic) . $extension;
      $profrespic = md5($profres) . $pextension;
      move_uploaded_file($_FILES["userpic"]["tmp_name"], "userimages/" . $userpic);
      move_uploaded_file($_FILES["profres"]["tmp_name"], "prof_of_res/" . $profrespic);
      $query = mysqli_query($con, "insert into tbladmapplications(UserId,CourseApplied,FatherName,MotherName,DOB,Nationality,Gender,CorrespondenceAdd,PermanentAdd,SecondaryBoard,SecondaryBoardyop,SSecondaryBoard,SSecondaryBoardyop,GraUni,GraUniyop,PGUni,PGUniyop,UserPic,ProfRes) value('$uid','$coursename','$fathername','$mothername','$dob','$nationality','$gender','$coradd','$peradd','$secboard','$secyop','$ssecboard','$ssecyop','$grauni','$grayop','$pguni','$pgyop','$userpic', '$profrespic')");
      if ($query) {

        echo '<script>alert("Data has been added successfully.")</script>';
        echo "<script>window.location.href ='admission-form.php'</script>";
      } else {
        echo '<script>alert("Something Went Wrong. Please try again.")</script>';
        echo "<script>window.location.href ='admission-form.php'</script>";
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
              <h1 class="h3 mb-0 text-gray-800">Admission Application Form</h1>
            </div>

            <!-- Content Row -->
            <!-- Admission Form Contents -->
            <div class="row">
              <?php
              $stuid = $_SESSION['uid'];
              $query = mysqli_query($con, "select * from tbladmapplications where  UserId=$stuid");
              $rw = mysqli_num_rows($query);
              if ($rw > 0) {
                while ($row = mysqli_fetch_array($query)) {
              ?>
                  <p style="font-size:16px; color:red" align="center">Your Admission Form has already been submitted.</p>
                  <table class="table mb-0">
                    <tr>
                      <th>Course Applied</th>
                      <td><?php echo $row['CourseApplied']; ?></td>
                    </tr>
                    <tr>
                      <th>Student Picture</th>
                      <td><img src="userimages/<?php echo $row['UserPic']; ?>" width="200" height="150"></td>
                    </tr>
                    <tr>
                      <th>Father's Name</th>
                      <td><?php echo $row['FatherName']; ?></td>
                    </tr>
                    <tr>
                      <th>Mother's Name</th>
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
                      <td><img src="prof_of_res/<?php echo $row['ProfRes']; ?>" width="200" height="150"></td>
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
                    <tr>
                      <th>Admin Remark</th>
                      <td><?php echo $row['AdminRemark']; ?></td>
                    </tr>
                    <tr>
                      <th>Admin Status</th>
                      <td><?php
                          if ($row['AdminStatus'] == "") {
                            echo "admin remark is pending";
                          }

                          if ($row['AdminStatus'] == "1") {
                            echo "Selected";
                          }

                          if ($row['AdminStatus'] == "2") {
                            echo "Rejected";
                          }
                          ?></td>
                    </tr>
                    <tr>
                      <th>Admin Remark Date</th>
                      <td><?php echo $row['AdminRemarkDate']; ?></td>
                    </tr>
                  </table>
                  <br>
                  <?php

                  if ($row['AdminStatus'] == "") {
                  ?>
                    <p style="text-align: center;font-size: 20px;"><a href="edit-appform.php?editid=<?php echo $row['ID']; ?>">Edit Details</a></p>
                <?php }
                }
              } else { ?>
                <form name="submit" method="post" enctype="multipart/form-data">
                  <section class="formatter" id="formatter">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title">Addimission Form</h4>
                          </div>
                          <div class="card-content">
                            <div class="card-body">


                              <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                  <fieldset>
                                    <h5>Course Applied </h5>
                                    <div class="form-group">
                                      <select name='coursename' id="coursename" class="form-control white_bg" required="true">
                                        <option value="">Course Applied</option>
                                        <?php $query = mysqli_query($con, "select * from tblcourse");
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                          <option value="<?php echo $row['CourseName']; ?>"><?php echo $row['CourseName']; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </fieldset>

                                </div>

                                <div class="col-xl-6 col-lg-12">
                                  <fieldset>
                                    <h5>Student Picture</h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="userpic" name="userpic" type="file" required>
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                  <fieldset>
                                    <h5>Father's Name </h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="fathername" name="fathername" type="text" required>
                                    </div>
                                  </fieldset>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                  <fieldset>
                                    <h5>Mother's Name </h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="mothername" name="mothername" type="text" required>
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xl-4 col-lg-12">
                                  <fieldset>
                                    <h5>DOB </h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="dob" name="dob" type="date" required>
                                      <small class="text-muted">DOB Must be in this format (MM-DD-YYYY)</small>
                                    </div>

                                  </fieldset>
                                </div>
                                <div class="col-xl-4 col-lg-12">
                                  <fieldset>
                                    <h5>Nationality </h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="nationality" name="nationality" type="text" required>
                                    </div>

                                  </fieldset>
                                </div>
                                <div class="col-xl-4 col-lg-12">
                                  <fieldset>
                                    <h5>Gender </h5>
                                    <div class="form-group">

                                      <select class="form-control white_bg" id="gender" name="gender" required>
                                        <option value="">Select</option>
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
                                      <input class="form-control white_bg" id="coradd" name="coradd" type="text" required>
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                  <fieldset>
                                    <h5>Permanent Address </h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="peradd" name="peradd" type="text" required>
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                  <fieldset>
                                    <h5>Proof of Residence</h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="profres" name="profres" type="file" required>
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
                                      <th>Board / University</th>
                                      <th>Year</th>
                                    </tr>
                                    <tr>
                                      <th>10th(Secondary)</th>
                                      <td> <input class="form-control white_bg" id="10thboard" name="10thboard" placeholder="Board / University" type="text" required></td>
                                      <td> <input class="form-control white_bg" id="10thpyeaer" name="10thpyear" placeholder="Year" type="number" required></td>
                                    </tr>
                                    <tr>
                                      <th>12th(Senior Secondary)</th>
                                      <td> <input class="form-control white_bg" id="12thboard" name="12thboard" placeholder="Board / University" type="text" required></td>
                                      <td> <input class="form-control white_bg" id="12thboard" name="12thpyear" placeholder="Year" type="number" required></td>
                                    </tr>
                                    <tr>
                                      <th>Graduation</th>
                                      <td> <input class="form-control white_bg" id="graduation" name="graduation" placeholder="Board / University" type="text"></td>
                                      <td> <input class="form-control white_bg" id="graduationpyeaer" name="graduationpyeaer" placeholder="Year" type="number"></td>
                                    </tr>
                                    <tr>
                                      <th>Post Graduation</th>
                                      <td> <input class="form-control white_bg" id="postgraduation" name="postgraduation" placeholder="Board / University" type="text"></td>
                                      <td> <input class="form-control white_bg" id="pgpyeaer" name="pgpyear" placeholder="Year" type="number"></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              </hr>
                              <div class="row" style="margin-top: 2%">
                                <div class="col-xl-6 col-lg-12">
                                  <button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Submit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                <?php } ?>
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
<?php  } ?>