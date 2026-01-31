<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
        $result = mysqli_query($conn, "SELECT image FROM cars WHERE id = $id");
    $car = mysqli_fetch_assoc($result);
    $image_path = "assets/" . $car['image'];
    if (file_exists($image_path)) {
        unlink($image_path); 
    }
    $delete_query = "DELETE FROM cars WHERE id = $id";
    if (mysqli_query($conn, $delete_query)) {
        header("Location: manage-fleet.php?msg=deleted");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>