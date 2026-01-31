<?php
include 'db.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = (int)$_GET['id'];
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    $query = "UPDATE bookings SET status = '$status' WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: admin-dashboard.php?tab=bookings&msg=success");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>