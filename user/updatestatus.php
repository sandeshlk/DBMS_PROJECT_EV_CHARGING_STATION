<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in.";
    exit;
}
if (isset($_POST['update_status'])) {
    include 'connection_proc.php'; //connect to your database

    //Call the stored procedure
    $user_id = $_SESSION['user_id'];
mysqli_query($conn, "CALL update_reservation_status($user_id)");

    //Check for errors
    if (!mysqli_errno($conn)) {
        echo "Reservation status updated successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
