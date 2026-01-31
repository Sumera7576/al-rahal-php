<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    exit("Unauthorized Access");
}
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = (int)$_GET['id'];
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    $update_query = "UPDATE bookings SET status = '$status' WHERE id = $id";
    
    if (mysqli_query($conn, $update_query)) {
        header("Location: view-bookings.php?msg=status_updated");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>