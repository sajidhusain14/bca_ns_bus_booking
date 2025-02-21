<?php 
session_start();
// Database Connection
include('includes/config.php');

// Validating Session
if(strlen($_SESSION['aid'])==0) { 
    header('location:index.php');
    exit(); // ✅ Prevent further execution if session is invalid
} else {
    // Code for change Password
    if(isset($_POST['change'])) {
        $admid = $_SESSION['aid'];
        $cpassword = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);

        // ✅ Fixing SQL query syntax (using ⁠ mysqli_num_rows ⁠ instead of ⁠ $row>0 ⁠)
        $query = mysqli_query($con, "SELECT ID FROM tbladmin WHERE ID='$admid' AND Password='$cpassword'");
        if(mysqli_num_rows($query) > 0) { 
            $ret = mysqli_query($con, "UPDATE tbladmin SET Password='$newpassword' WHERE ID='$admid'");
            if ($ret) {
                echo '<script>alert("Your password was successfully changed.");</script>';
            } else {
                echo '<script>alert("Something went wrong. Please try again.");</script>';
            }
        } else {
            echo '<script>alert("Your current password is incorrect.");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bus Booking System | Between Dates Report</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include_once("includes/navbar.php");?>
  <!-- Main Sidebar Container -->
  <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>B/w Dates Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">B/w Dates Report</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">B/w Dates Booking Report</h3>
              </div>
              <form method="post" name="bwdatesreport" action="bwdates-report-details.php">  
                <div class="card-body">
                  <div class="form-group">
                    <label for="fdate">From Date</label>
                    <input class="form-control" id="fdate" name="fdate" type="date" required>
                  </div>
                  <div class="form-group">
                    <label for="tdate">To Date</label>
                    <input class="form-control" id="tdate" type="date" name="tdate" required>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include_once('includes/footer.php');?>
</div>

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
