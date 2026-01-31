<?php
include 'db.php';
include 'header.php';
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$car_id = (int)$_GET['id'];
$query = "SELECT * FROM cars WHERE id = $car_id";
$result = mysqli_query($conn, $query);
$car = mysqli_fetch_assoc($result);

if (!$car) {
    echo "<div class='bg-[#050810] min-h-screen flex items-center justify-center text-white'>
            <div class='text-center'>
                <h2 class='text-4xl font-bold mb-4'>Vehicle Not Found!</h2>
                <a href='index.php' class='text-blue-500 hover:underline'>Return to Home</a>
            </div>
          </div>";
    exit();
}
$image_path = "assets/" . $car['image'];
if (empty($car['image']) || !file_exists($image_path)) {
    $display_image = "https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1200&auto=format&fit=crop"; 
} else {
    $display_image = $image_path;
}
?>

<div class="bg-[#050810] min-h-screen py-24 text-white font-sans">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <div class="space-y-8">
                <div class="relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl group">
                    <img src="<?php echo $display_image; ?>" 
                         alt="<?php echo $car['name']; ?>" 
                         class="w-full h-[450px] object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <div class="absolute top-6 left-6 bg-blue-600 px-4 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">
                        <?php echo isset($car['category']) ? $car['category'] : 'Premium'; ?>
                    </div>
                </div>
                
                <div class="flex justify-between items-end">
                    <div>
                        <h1 class="text-4xl font-black italic uppercase tracking-tighter"><?php echo $car['name']; ?></h1>
                        <p class="text-gray-400 mt-2 flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-blue-500"></i> 
                            <?php echo isset($car['location']) ? $car['location'] : 'Dubai, UAE'; ?>
                        </p>
                    </div>
                    <div class="text-right">
                        <span class="text-3xl font-black text-blue-500">AED <?php echo $car['price']; ?></span>
                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">/ Per Day</p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 border-t border-white/5 pt-8">
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center hover:bg-white/10 transition-all">
                        <i data-lucide="gauge" class="w-5 h-5 mx-auto text-blue-400 mb-2"></i>
                        <span class="text-xs font-bold block"><?php echo isset($car['speed']) ? $car['speed'] : '300 km/h'; ?></span>
                    </div>
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center hover:bg-white/10 transition-all">
                        <i data-lucide="users" class="w-5 h-5 mx-auto text-blue-400 mb-2"></i>
                        <span class="text-xs font-bold block"><?php echo isset($car['seats']) ? $car['seats'] : '2'; ?> Seats</span>
                    </div>
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center hover:bg-white/10 transition-all">
                        <i data-lucide="fuel" class="w-5 h-5 mx-auto text-blue-400 mb-2"></i>
                        <span class="text-xs font-bold block"><?php echo isset($car['transmission']) ? $car['transmission'] : 'Auto'; ?></span>
                    </div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl self-start">
                <h3 class="text-2xl font-bold mb-8 flex items-center gap-2">Secure <span class="text-blue-500 text-3xl italic">Reservation</span></h3>
                
                <form action="confirm-booking.php" method="POST" class="space-y-6">
                    <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                    <input type="hidden" name="car_price" value="<?php echo $car['price']; ?>">

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest">Your Full Name</label>
                        <input type="text" name="name" placeholder="Enter Your Name" required 
                               class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 outline-none transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest">Phone Number (WhatsApp)</label>
                        <input type="tel" name="phone" placeholder="Enter Your Number" required 
                               class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 outline-none transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest">Pickup Date</label>
                            <input type="date" name="pickup" required 
                                   class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest">Return Date</label>
                            <input type="date" name="return" required 
                                   class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-white focus:border-blue-500 outline-none transition-all">
                        </div>
                    </div>

                    <button type="submit" name="book_now" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-5 rounded-2xl shadow-xl shadow-blue-900/40 uppercase tracking-widest transition-all mt-4 hover:-translate-y-1">
                        Complete Booking Request
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>lucide.createIcons();</script>
<?php include 'footer.php'; ?>
