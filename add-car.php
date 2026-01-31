<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_car'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $speed = mysqli_real_escape_string($conn, $_POST['speed']);
    $transmission = mysqli_real_escape_string($conn, $_POST['transmission']);
    $seats = mysqli_real_escape_string($conn, $_POST['seats']);
    $image_name = $_FILES['car_image']['name'];
    $tmp_name = $_FILES['car_image']['tmp_name'];
    $target_folder = "assets/" . $image_name;

    if (move_uploaded_file($tmp_name, $target_folder)) {
        $query = "INSERT INTO cars (name, price, category, image, location, speed, transmission, seats) 
                  VALUES ('$name', '$price', '$category', '$image_name', '$location', '$speed', '$transmission', '$seats')";
        
        if (mysqli_query($conn, $query)) {
            $success = "Vehicle added successfully to the fleet!";
        } else {
            $error = "Database Error: " . mysqli_error($conn);
        }
    } else {
        $error = "Failed to upload image. Check assets folder permissions.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>Add New Vehicle | Admin</title>
</head>
<body class="bg-[#050810] text-white min-h-screen p-8">
    
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-10">
            <h1 class="text-3xl font-bold italic tracking-wider uppercase">Add <span class="text-blue-500">New Beast</span></h1>
            <a href="admin-dashboard.php" class="text-gray-400 hover:text-white flex items-center gap-2">
                <i data-lucide="arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <form action="add-car.php" method="POST" enctype="multipart/form-data" class="bg-white/5 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl space-y-8">
            
            <?php if(isset($success)) echo "<p class='bg-green-500/20 text-green-400 p-4 rounded-xl border border-green-500/30 text-center font-bold'>$success</p>"; ?>
            <?php if(isset($error)) echo "<p class='bg-red-500/20 text-red-400 p-4 rounded-xl border border-red-500/30 text-center font-bold'>$error</p>"; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-blue-400 uppercase tracking-widest ml-1">Vehicle Name</label>
                    <input type="text" name="name" placeholder="Enter Vehicle Name" required class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-blue-400 uppercase tracking-widest ml-1">Daily Price (AED)</label>
                    <input type="number" name="price" placeholder="Enter Price" required class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-blue-400 uppercase tracking-widest ml-1">Category</label>
                    <select name="category" class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 outline-none">
                        <option value="Luxury">Luxury</option>
                        <option value="Sports">Sports</option>
                        <option value="SUV">SUV</option>
                        <option value="Economical">Economical</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-blue-400 uppercase tracking-widest ml-1">Transmission</label>
                    <select name="transmission" class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 outline-none">
                        <option value="Auto">Auto</option>
                        <option value="Manual">Manual</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-blue-400 uppercase tracking-widest ml-1">Seats</label>
                    <input type="number" name="seats" placeholder="Max Seat" class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-blue-400 uppercase tracking-widest ml-1">Max Speed (km/h)</label>
                    <input type="text" name="speed" placeholder="Min Speed" class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-blue-400 uppercase tracking-widest ml-1">Location</label>
                    <input type="text" name="location" placeholder="Enter Loctaion" class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 outline-none">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-blue-400 uppercase tracking-widest ml-1">Main Cover Image</label>
                <div class="border-2 border-dashed border-white/10 rounded-2xl p-8 text-center hover:border-blue-500/50 transition-all">
                    <input type="file" name="car_image" required class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                </div>
            </div>

            <button type="submit" name="add_car" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-5 rounded-2xl shadow-xl shadow-blue-900/40 uppercase tracking-widest transition-all">
                Publish Vehicle to Fleet
            </button>
        </form>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>