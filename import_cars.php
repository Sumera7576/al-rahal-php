<?php
include 'db.php';

$carData = [
    ['name' => "Lamborghini Urus", 'category' => "Sports", 'location' => "Dubai", 'price' => 3500, 'speed' => "305 km/h", 'image' => "https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=800&q=80"],
    ['name' => "Ferrari 488 Spider", 'category' => "Supercar", 'location' => "Abu Dhabi", 'price' => 4200, 'speed' => "340 km/h", 'image' => "https://images.unsplash.com/photo-1592198084033-aade902d1aae?auto=format&fit=crop&w=800&q=80"],
    ['name' => "Mercedes G63 AMG", 'category' => "SUV", 'location' => "Dubai", 'price' => 2500, 'speed' => "220 km/h", 'image' => "mercedes.jpeg"],
    ['name' => "Rolls Royce Ghost", 'category' => "Luxury", 'location' => "Dubai", 'price' => 5000, 'speed' => "250 km/h", 'image' => "ranger.jpeg"],
    ['name' => "Range Rover Sport", 'category' => "SUV", 'location' => "Sharjah", 'price' => 1800, 'speed' => "210 km/h", 'image' => "sport.jpeg"]
];

foreach ($carData as $car) {
    $name = $car['name'];
    $cat = $car['category'];
    $loc = $car['location'];
    $prc = $car['price'];
    $spd = $car['speed'];
    $img = $car['image'];

    $sql = "INSERT INTO cars (name, category, location, price, speed, image) VALUES ('$name', '$cat', '$loc', '$prc', '$spd', '$img')";
    mysqli_query($conn, $sql);
}

echo "Zabardast! Saara React data Database mein move ho gaya hai.";
?>