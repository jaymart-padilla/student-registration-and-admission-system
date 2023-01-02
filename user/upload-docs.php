<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['uid'] == 0)) {
  header('location:logout.php');
} else {

  if (isset($_POST['submit'])) {
    $uid = $_SESSION['uid'];
    $tc = $_FILES["tcimage"]["name"];
    $tenmarksheet = $_FILES["hscimage"]["name"];
    $twlevemaksheet = $_FILES["sscimage"]["name"];
    $gramarksheet = $_FILES["graimage"]["name"];
    $pgmarksheet = $_FILES["pgraimage"]["name"];

    $extensiontc = substr($tc, strlen($tc) - 4, strlen($tc));
    $extensiontm = substr($tenmarksheet, strlen($tenmarksheet) - 4, strlen($tenmarksheet));
    $extensiontwm = substr($twlevemaksheet, strlen($twlevemaksheet) - 4, strlen($twlevemaksheet));

    // allowed extensions
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif", ".pdf", ".PDF");
    // Validation for allowed extensions .in_array() function searches an array for a specific value.
    if (!in_array($extensiontc, $allowed_extensions)) {
      echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
    } elseif (!in_array($extensiontm, $allowed_extensions)) {
      echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
    } elseif (!in_array($extensiontwm, $allowed_extensions)) {
      echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
    } else {
      //rename upload file
      $tc = md5($tc) . $extensiontc;
      $tm = md5($tenmarksheet) . $extensiontm;
      $twm = md5($twlevemaksheet) . $extensiontwm;
      if ($gramarksheet != "") {
        $gra = md5($gramarksheet) . $extensiongra;
      } else {
        $gra = "";
      }

      if ($pgmarksheet != "") {
        $pgra = md5($pgmarksheet) . $extensionpgra;
      } else {
        $pgra = "";
      }
      move_uploaded_file($_FILES["tcimage"]["tmp_name"], "userdocs/" . $tc);
      move_uploaded_file($_FILES["hscimage"]["tmp_name"], "userdocs/" . $tm);
      move_uploaded_file($_FILES["sscimage"]["tmp_name"], "userdocs/" . $twm);
      move_uploaded_file($_FILES["graimage"]["tmp_name"], "userdocs/" . $gra);
      move_uploaded_file($_FILES["pgraimage"]["tmp_name"], "userdocs/" . $pgra);
      $query = mysqli_query($con, "insert into tbldocument(UserID,TransferCertificate,TenMarksheeet,TwelveMarksheet,GraduationCertificate,PostgraduationCertificate) value('$uid','$tc','$tm','$twm','$gra','$pgra')");
      if ($query) {

        echo '<script>alert("Data has been added successfully.")</script>';
        echo "<script>window.location.href ='upload-doc.php'</script>";
      } else {
        echo '<script>alert("Something Went Wrong. Please try again.")</script>';
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
              <h1 class="h3 mb-0 text-gray-800">Upload Docs</h1>
            </div>

            <!-- Content Row -->
            <!-- Upload Docs Contents -->
            <div class="row">
              <!-- Input Mask start -->
              <!-- Formatter start -->
              <?php
              $stuid = $_SESSION['uid'];
              $ret = mysqli_query($con, "select AdminStatus from  tbladmapplications join tbluser on tbluser.ID=tbladmapplications.UserID where tbluser.ID='$stuid' ");
              $num = mysqli_fetch_array($ret);
              $adstatus = $num['AdminStatus'];
              if ($num > 0 && $adstatus == '1') {

                $query = mysqli_query($con, "select * from tbldocument where  UserID=$stuid");
                $rw = mysqli_num_rows($query);
                if ($rw > 0) {
                  while ($row = mysqli_fetch_array($query)) {
              ?>
                    <p style="font-size:16px; color:red" align="center">Your document is already uploaded.</p>

                    <table class="table mb-0">

                      <tr>
                        <th>Transfer Certificate</th>
                        <td><a href="userdocs/<?php echo $row['TransferCertificate']; ?>" target="_blank">View File </a></td>
                      </tr>
                      <tr>
                        <th>10th Marksheet</th>
                        <td><a href="userdocs/<?php echo $row['TenMarksheeet']; ?>" target="_blank">View File </a></td>
                      </tr>
                      <tr>
                        <th>12th Marksheet</th>
                        <td><a href="userdocs/<?php echo $row['TwelveMarksheet']; ?>" target="_blank">View File </a></td>
                      </tr>
                      <tr>
                        <th>Graduation Certificate</th>
                        <td>
                          <?php if ($row['GraduationCertificate'] == "") { ?>
                            NA
                          <?php } else { ?>
                            <a href="userdocs/<?php echo $row['GraduationCertificate']; ?>" target="_blank">View File </a>
                          <?php } ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Post Graduation Certificate</th>
                        <td>
                          <?php if ($row['PostgraduationCertificate'] == "") { ?>
                            NA
                          <?php } else { ?>
                            <a href="userdocs/<?php echo $row['PostgraduationCertificate']; ?>" target="_blank">View File </a>
                          <?php } ?>
                        </td>
                      </tr>




                    </table>
                  <?php }
                } else { ?>
                  <form name="submit" method="post" enctype="multipart/form-data">
                    <section class="formatter" id="formatter">
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-header">
                              <h4 class="card-title">Upload Documents</h4>
                            </div>
                            <div class="card-content">
                              <div class="card-body">

                                <div class="row">
                                  <div class="col-xl-6 col-lg-12">
                                    <fieldset>
                                      <h5>Transfer Certificate(TC)</h5>
                                      <div class="form-group">
                                        <input class="form-control white_bg" id="tcimage" name="tcimage" type="file" required>
                                      </div>
                                    </fieldset>

                                  </div>
                                  <div class="col-xl-6 col-lg-12">
                                    <fieldset>
                                      <h5>10th Marksheet </h5>
                                      <div class="form-group">
                                        <input class="form-control white_bg" id="hscimage" name="hscimage" type="file" required>
                                      </div>
                                    </fieldset>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xl-6 col-lg-12">
                                    <fieldset>
                                      <h5>12th Mark Sheet </h5>
                                      <div class="form-group">
                                        <input class="form-control white_bg" id="sscimage" name="sscimage" type="file" required>
                                      </div>
                                    </fieldset>
                                  </div>
                                  <div class="col-xl-6 col-lg-12">
                                    <fieldset>
                                      <h5>Graduation Certificate(if any) </h5>
                                      <div class="form-group">
                                        <input class="form-control white_bg" id="graimage" name="graimage" type="file">
                                      </div>
                                    </fieldset>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xl-4 col-lg-12">
                                    <fieldset>
                                      <h5>Post Graduation Certificate(if any) </h5>
                                      <div class="form-group">
                                        <input class="form-control white_bg" id="pgraimage" name="pgraimage" type="file">
                                      </div>
                                    </fieldset>
                                  </div>
                                </div>
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
                  <?php }
              } else if ($num > 0 && $adstatus == '') { ?>
                  <p> Your application is pending with admin </p>
                <?php } else if ($num > 0 && $adstatus == '2') { ?>
                  <p> Your application has been rejected by admin </p>
                <?php } else { ?>
                  <p> First fill the application then upload docs. </p>
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