<?php session_start();
// Database Connection
include('includes/config.php');
if(isset($_POST['submit'])){

$boatid=$_GET['bid'];
$fname=$_POST['fname'];
$emailid=$_POST['emailid'];
$phonenumber=$_POST['phonenumber'];
$bookingdatefrom=$_POST['bookingdatefrom'];
$bookingdateto=$_POST['bookingdateto'];
$bookingtime=$_POST['bookingtime'];
$nopeople=$_POST['nopeople'];
$notes=$_POST['notes'];
$bno=mt_rand(100000000,9999999999);

  $ret=mysqli_query($con,"SELECT * FROM tblbookings where ('$bookingdatefrom' BETWEEN date(BookingDateFrom) and date(BookingDateTo) || '$bookingdateto' BETWEEN date(BookingDateFrom) and date(BookingDateTo) || date(BookingDateFrom) BETWEEN '$bookingdatefrom' and '$bookingdateto') and BoatID='$boatid' and BookingStatus='Accepted'");
     $count=mysqli_num_rows($ret);

  if($count==0){


//Code for Insertion
$query=mysqli_query($con,"insert into tblbookings(BoatID,BookingNumber,FullName,EmailId,PhoneNumber,BookingDateFrom,BookingDateTo,BookingTime,NumnerofPeople,Notes) values('$boatid','$bno','$fname','$emailid','$phonenumber','$bookingdatefrom','$bookingdateto','$bookingtime','$nopeople','$notes')");
if($query){
echo '<script>alert("Your bus booking request has been sent successfully. Booking number is "+"'.$bno.'")</script>';
echo "<script type='text/javascript'> document.location = 'services.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}

} 

else {
echo "<script>alert('Bus not available for these dates. Please select the diffrent dates');</script>";
}}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bus Booking System || Booking Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">




</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

  


    
    <?php include_once("includes/navbar.php");?>
    
    <div class="intro-section" style="background-image: url('images/ns_bus_30.png');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
              <h1>Bus Booking</h1>
              <p><a href="faqs.php" class="btn btn-primary py-3 px-5">Faqs!!</a></p>
            </div>
          </div>
        </div>
      </div>
    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p><img src="images/ns_bus_30.png" alt="Image" class="img-fluid"></p>
          </div>
          <div class="col-md-6">
            <span class="text-serif text-primary">Book Now</span>
            <h3 class="heading-92913 text-black">Book A Bus</h3>
            <form action="#" class="row" method="post">
              <div class="form-group col-md-6">
                <label for="input-1">Full Name:</label>
                <input type="text" class="form-control" name="fname" required="true">
              </div>
              <!-- <div class="form-group col-md-6">
                <label for="input-2">Number of People:</label>
                <input type="text" class="form-control" name="nopeople" required="true">
              </div> -->

              <div class="form-group col-md-6">
        <label for="input-2">Number of People:</label>
        <input type="number" class="form-control" name="nopeople" id="nopeople" required="true" placeholder="Enter number less than 76" oninput="validateNumber(this)">
        <small id="error-message" class="text-danger" style="display: none;">Please enter a number less than 76.</small>
      </div>
<!-- 
              <div class="form-group col-md-6">
                <label for="input-3">Date From:</label>
                <input type="text" class="form-control datepicker" name="bookingdatefrom" required="true">
              </div>
              <div class="form-group col-md-6">
                <label for="input-4">Date To:</label>
                <input type="text" class="form-control datepicker" name="bookingdateto" required="true">
              </div> -->

              <div class="form-group col-md-6">
    <label for="input-3">Date From:</label>
    <input type="text" class="form-control datepicker" name="bookingdatefrom" id="bookingdatefrom" required="true">
</div>
<div class="form-group col-md-6">
    <label for="input-4">Date To:</label>
    <input type="text" class="form-control datepicker" name="bookingdateto" id="bookingdateto" required="true">
</div>
              
             <div class="form-group col-md-6">
                <label for="input-4">Time:</label>
                <input type="time" class="form-control timepicker" name="bookingtime" required="true">
              </div>

              <div class="form-group col-md-6">
                <label for="input-6">Email Address</label>
                <input type="text" class="form-control" name="emailid" required="true">
              </div>

              <!-- <div class="form-group col-md-6">
                <label for="input-7">Phone Number</label>
                <input type="text" class="form-control" name="phonenumber" maxlength="10" pattern="[0-9]+" required="true"> 
              </div> -->


              <!-- new add chatgpt -->

              <div class="form-group col-md-6">
    <label for="input-7">Phone Number</label>
    <input type="number" class="form-control" name="phonenumber" id="phonenumber" inputmode="numeric" min="0" maxlength="10" required oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
</div>

              <div class="form-group col-md-12">
                <label for="input-8">Notes</label>
                <textarea cols="30" rows="5" class="form-control" name="notes"></textarea>
              </div>

              <div class="form-group col-md-12">
                <input type="submit" name="submit" class="btn btn-primary py-3 px-5" value="Book Now">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    

    <div class="site-section bg-image overlay" style="background-image: url('images/ns_bus_30.png');">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="text-white">Get In Touch With Us</h2>
            <p class="lead text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p class="mb-0"><a href="faqs.php" class="btn btn-warning py-3 px-5 text-white">Contact Us</a></p>
          </div>
        </div>
      </div>
    </div>

    <?php include_once("includes/footer.php");?>
    

  </div>
  <!-- .site-wrap -->


  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/></svg></div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>




  <script src="js/main.js"></script>

</body>
  <!-- <script type="text/javascript">
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
        });
    </script> -->


<!-- new add chatgpt -->
<script type="text/javascript">
    $(document).ready(function() {
        // Initialize datepicker
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            startDate: new Date() // Restrict selection to today and future dates
        });

        // Form submission validation
        $('form').on('submit', function(event) {
            var bookingDateFrom = new Date($('#bookingdatefrom').val());
            var bookingDateTo = new Date($('#bookingdateto').val());
            var today = new Date();
            today.setHours(0, 0, 0, 0); // Set time to midnight for accurate comparison

            if (bookingDateFrom < today || bookingDateTo < today) {
                alert('Please select today\'s date or a future date.');
                event.preventDefault(); // Prevent form submission
            } else if (bookingDateFrom > bookingDateTo) {
                alert('The "Date From" should be before or equal to the "Date To".');
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>

<script>
    function validateNumber(input) {
      const errorMessage = document.getElementById('error-message');
      const value = input.value;

      // Check if the input is a number and less than 76
      if (isNaN(value) || value < 1 || value > 75) {
        errorMessage.style.display = 'block';
        input.setCustomValidity('Invalid input');
      } else {
        errorMessage.style.display = 'none';
        input.setCustomValidity('');
      }
    }
  </script>

</html>
<!-- apache_request_headersasd
<i class="fa fa-adjustasdas
das
das
date_subdas


asd


" aria-hidden="true"></i>
<i class="fa fa-adjustasd
as
asd
ads" aria-hidden="true"></i> -->