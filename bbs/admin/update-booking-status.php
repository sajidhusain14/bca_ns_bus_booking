<?php
session_start();
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingId = $_POST['bookingId'];
    $newStatus = $_POST['newStatus'];

    // Update the booking status in the database
    $query = mysqli_query($con, "UPDATE tblbookings SET BookingStatus = '$newStatus' WHERE ID = '$bookingId'");

    if ($query) {
        echo 'Status updated successfully!';
    } else {
        echo 'Error updating status.';
    }
}
?>

<!-- new add chatgpt -->