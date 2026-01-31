<?php
include 'db.php';

if (isset($_POST['book_now'])) {
    $car_id = (int)$_POST['car_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $pickup = mysqli_real_escape_string($conn, $_POST['pickup']);
    $return = mysqli_real_escape_string($conn, $_POST['return']);
    $total_price = (int)$_POST['car_price']; 
    $query = "INSERT INTO bookings (car_id, customer_name, customer_phone, pickup_date, return_date, total_price, status) 
              VALUES ('$car_id', '$name', '$phone', '$pickup', '$return', '$total_price', 'Pending')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Booking Request Sent! Admin will contact you soon.');
                window.location.href='index.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>