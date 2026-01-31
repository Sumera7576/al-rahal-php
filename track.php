<?php
include 'db.php';
include 'header.php';

$search_result = null;

if (isset($_POST['track_now'])) {
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $query = "SELECT bookings.*, cars.name as car_name 
              FROM bookings 
              JOIN cars ON bookings.car_id = cars.id 
              WHERE customer_phone = '$phone' 
              ORDER BY bookings.id DESC LIMIT 1";
    
    $result = mysqli_query($conn, $query);
    $search_result = mysqli_fetch_assoc($result);
}
?>

<div class="bg-[#050810] min-h-screen py-24 text-white text-center">
    <div class="max-w-md mx-auto px-6">
        <h2 class="text-3xl font-bold mb-8">Track Your <span class="text-blue-500">Ride</span></h2>
        
        <form method="POST" class="mb-12">
            <input type="tel" name="phone" placeholder="Enter Your Phone Number" required 
                   class="w-full bg-white/5 border border-white/10 p-4 rounded-xl mb-4 outline-none focus:border-blue-500">
            <button type="submit" name="track_now" class="w-full bg-blue-600 py-4 rounded-xl font-bold">Track Now</button>
        </form>

        <?php if ($search_result): ?>
            <div class="bg-white/5 p-8 rounded-[2rem] border border-white/10 backdrop-blur-xl">
                <p class="text-gray-400 text-sm uppercase tracking-widest mb-2">Booking Status</p>
                <h3 class="text-2xl font-bold mb-4"><?php echo $search_result['car_name']; ?></h3>
                
                <?php 
                    $status = $search_result['status'];
                    $color = ($status == 'Confirmed') ? 'text-green-400' : (($status == 'Rejected') ? 'text-red-400' : 'text-yellow-400');
                ?>
                <div class="text-4xl font-black <?php echo $color; ?> italic uppercase">
                    <?php echo $status; ?>
                </div>
                <p class="text-gray-500 text-xs mt-4 italic">Request Date: <?php echo $search_result['pickup_date']; ?></p>
            </div>
        <?php elseif (isset($_POST['track_now'])): ?>
            <p class="text-red-400">No booking found for this number.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>