<?php session_start();
// Database Connection
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bus Booking System || Services</title>
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
    

   <div class="intro-section" style="background-image: url('images/ns_bus_12.webp'); background-size: cover; background-position: center; background-repeat: no-repeat; height: 100vh;width: 100%;">
   <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
              <h1>Our Services</h1>
       
              <p><a href="faqs.php" class="btn btn-primary py-3 px-5">Faqs!</a></p>
            </div>
          </div>
        </div>
      </div>

    
<?php

// Number of records per page
$limit = 6;

// Get the current page number from URL (if not present, default to 1)
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}

// Calculate the offset for the SQL query
$offset = ($page - 1) * $limit;

// Fetch the total number of records
$total_query = mysqli_query($con, "SELECT COUNT(*) FROM tblboat");
$total_row = mysqli_fetch_array($total_query);
$total_records = $total_row[0];

// Calculate total pages
$total_pages = ceil($total_records / $limit);

// Fetch the boats for the current page with limit and offset
// $query = mysqli_query($con, "SELECT * FROM tblboat LIMIT $limit OFFSET $offset");


  // new add chatgpt
  $query = mysqli_query($con, "SELECT * FROM tblboat WHERE ID NOT IN (SELECT BoatId FROM tblbookings WHERE BookingStatus = 'Accepted') LIMIT $limit OFFSET $offset");

?>

<div class="py-5">
  <div class="container">
    <!-- Section Heading -->
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center">
        <span class="text-serif text-primary">Destination</span>
        <h3 class="heading-92913 text-black text-center">Our Destinations</h3>
      </div>
    </div>

    <!-- Destinations Grid -->
    <div class="row">
      
     <!-- new add chatgpt -->

     <?php while ($result = mysqli_fetch_array($query)) { ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="service-39381 border rounded">
            <!-- Image with fixed size and responsive scaling -->
            <div class="img-container" style="width: 100%; height: 200px; overflow: hidden;">
                <img 
                    src="admin/images/<?php echo $result['Image']; ?>" 
                    alt="Image" 
                    class="img-fluid w-100 h-100" 
                    style="object-fit: cover;"
                >
            </div>
            <!-- Content -->
            <div class="p-4">
                <h3>
                    <a href="boat-details.php?bid=<?php echo $result['ID']; ?>">
                        <span class="icon-room mr-1 text-success"></span> 
                        <?php echo $result['Source']; ?> &mdash; <?php echo $result['Destination']; ?>
                    </a>
                </h3>
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <?php
                        // Check if the bus is available
                        $busId = $result['ID'];
                        $statusQuery = mysqli_query($con, "SELECT BookingStatus FROM tblbookings WHERE BoatId = '$busId' AND BookingStatus = 'Accepted'");
                        if (mysqli_num_rows($statusQuery) > 0) {
                            echo '<button class="btn btn-danger text-white" disabled>Bus Not Available</button>';
                        } else {
                            echo '<a href="book-boat.php?bid=' . $result['ID'] . '" class="btn btn-success text-white">Book</a>';
                        }
                        ?>
                    </div>
                    <div class="ml-auto price">
                        <span class="bg-success text-white p-2 rounded">
                            ₹ <?php echo $result['Price']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


    </div>

    <!-- Pagination -->
    <div class="pagination justify-content-center mt-4">
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

</html>