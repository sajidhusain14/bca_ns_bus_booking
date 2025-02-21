
    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <span class="text-serif text-primary">Destination</span>
            <h3 class="heading-92913 text-black text-center">Our Destinations</h3>
          </div>
        </div>
        <div class="row">
         <?php $query=mysqli_query($con,"select * from tblboat limit 6");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="service-39381">
              <img src="admin/images/<?php echo $result['Image'];?>" alt="Image"  width="100%" max-height= "100%" height="auto%"  object-fit= "cover">
              <div class="p-4">
                <h3><a href="boat-details.php?bid=<?php echo $result['ID']; ?>"><span class="icon-room mr-1 text-success"></span> <?php echo $result['Source']?> &mdash; <?php echo $result['Destination']?></a></h3>
                <div class="d-flex">
          
                  <div class="ml-auto price">
                    <span class="bg-success">$<?php echo $result['Price']?></span>
                  </div>
                  
                </div>
              </div>
            </div>
          </div><?php $cnt++;} ?>
          
       

        </div>
      </div>
    </div>


    <!-- service bus menu -->


    <div class="py-5">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center">
        <span class="text-serif text-primary">Destination</span>
        <h3 class="heading-92913 text-black text-center">Our Destinations</h3>
      </div>
    </div>
    <div class="row">
      <?php while ($result = mysqli_fetch_array($query)) { ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="service-39381">
            <img src="admin/images/<?php echo $result['Image']; ?>" alt="Image" width="350" height="200">
            <div class="p-4">
              <h3><a href="boat-details.php?bid=<?php echo $result['ID']; ?>"><span class="icon-room mr-1 text-success"></span> <?php echo $result['Source']; ?> &mdash; <?php echo $result['Destination']; ?></a></h3>
              <div class="d-flex">
                <div class="mr-auto">
                  <a href="book-boat.php?bid=<?php echo $result['ID']; ?>" class="btn btn-success" style="color:white;">
                 Book</a>
                </div>
                <div class="ml-auto price">
                  <span class="bg-success">$<?php echo $result['Price']; ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

    <!-- Pagination Links -->
    <div class="pagination justify-content-center">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <!-- Previous Page Link -->
          <?php if ($page > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
          <?php else: ?>
            <li class="page-item disabled">
              <span class="page-link">&laquo;</span>
            </li>
          <?php endif; ?>

          <!-- Page Numbers -->
          <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
              <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
          <?php endfor; ?>

          <!-- Next Page Link -->
          <?php if ($page < $total_pages): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          <?php else: ?>
            <li class="page-item disabled">
              <span class="page-link">&raquo;</span>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>




<!-- status.php booking detail table -->



<?php if(isset($_POST['submit'])){

$emailid=$_POST['emailid'];
$phonenumber=$_POST['phonenumber'];
  ?>
<div class="col-md-12">
         <table id="example1" class="table table-bordered table-striped">
                  <thead>
                 <tr>
                    <th>#</th>
                    <th>Bookings No</th>
                    <th>Name</th>
                    <th>Email Id</th>
                    <th>Mobile No</th>
                    <th>No. People</th>
                    <th>Boking Date/Time</th>
                     <th>Posting Date</th>
                     <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
<?php $query=mysqli_query($con,"select * from tblbookings where PhoneNumber='$phonenumber' and EmailId='$emailid'");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>

                  <tr>
                    <td><?php echo $cnt;?></td>
                    <td><?php echo $result['BookingNumber']?></td>
                    <td><?php echo $result['FullName']?></td>
                    <td><?php echo $result['EmailId']?></td>
                   <td><?php echo $result['PhoneNumber']?></td>
                   <td><?php echo $result['NumnerofPeople']?></td>
                  
                    <td><?php echo $result['BookingDateFrom']?>/<?php echo $result['BookingTime']?></td>
                    <td><?php echo $result['postingDate']?></td>
                    <td><?php if($result['BookingStatus']==''): ?>
                    <span class="badge bg-warning text-dark">Not Processed Yet</span>
                  <?php elseif($result['BookingStatus']=='Accepted'): ?>
                    <span class="badge bg-success">Accepted</span>
                    <?php elseif($result['BookingStatus']=='Rejected'): ?>
                      <span class="badge bg-danger">Rejected</span>
                    <?php endif;?></td>
                    <th>
     <a href="booking-details.php?bid=<?php echo base64_encode($result['ID']);?>&&eml=<?php echo base64_encode($result['EmailId']);?>&&pno=<?php echo base64_encode($result['PhoneNumber']);?>" title="View Details" class="btn btn-primary btn-sm"> View Details</a> 
 </th>
                  </tr>
         <?php $cnt++;} ?>
             
                  </tbody>
                </table>

              </div>

<?php } ?>





<!-- bw-dates-report -->



<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { header('location:index.php');
}
else{
// Code for change Password
if(isset($_POST['change'])){
$admid=$_SESSION['aid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$query=mysqli_query($con,"select ID from tbladmin where ID='$admid' and   Password='$cpassword'");
$row=mysqli_fetch_array($query);
if($row>0){
$ret=mysqli_query($con,"update tbladmin set Password='$newpassword' where ID='$admid'");
echo '<script>alert("Your password successully changed.")</script>';
} else {

echo '<script>alert("Your current password is wrong.")</script>';
}



}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bus Booking System   | Between Dates Report</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!--Function Email Availabilty---->

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

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
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">B/w Dates Booking Report</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
<form method="post"  name="bwdatesreport" action="bwdates-report-details.php">  
                <div class="card-body">

<!-- From Date--->
   <div class="form-group">
                    <label for="exampleInputFullname">From Date</label>
                <input class="form-control" id="fdate" name="fdate"  type="date" required="true">
                  </div>
<!---To Date---->
 <div class="form-group">
<label for="exampleInputEmail1">To Date</label>
<input class="form-control " id="tdate" type="date" name="tdate" required="true">
</div>



      
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                </div>
              </form>
</div>
            <!-- /.card -->

        
       
          </div>
          <!--/.col (left) -->
  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('includes/footer.php');?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
<?php } ?>
