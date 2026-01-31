<?php 
include 'header.php'; 
include 'db.php'; 

$myBookings = null;
$error = '';
$phone = '';

if (isset($_POST['check_status'])) {
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    
    $query = "SELECT * FROM bookings WHERE customer_phone = '$phone' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $myBookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = "No booking found with this phone number.";
    }
}
?>

<div class="relative min-h-screen flex items-center justify-center font-sans pt-32 pb-12 px-4 overflow-hidden">
    
    <div class="fixed inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1920&q=80" 
             class="w-full h-full object-cover scale-110 motion-safe:animate-[pulse_10s_infinite]" 
             alt="Luxury Car Background" />
        
        <div class="absolute inset-0 bg-gradient-to-b from-[#050810]/90 via-[#050810]/70 to-[#050810]/95"></div>
        
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-blue-600/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-blue-900/30 rounded-full blur-[120px]"></div>
    </div>

    <div class="relative z-10 w-full max-w-2xl">
        <div class="text-center mb-10">
            <div class="inline-flex p-4 rounded-2xl bg-blue-600/10 border border-blue-500/20 backdrop-blur-xl mb-6">
                <i data-lucide="shield-check" class="w-8 h-8 text-blue-500"></i>
            </div>
            <h2 class="text-4xl font-extrabold text-white mb-3 tracking-tight">Client <span class="text-blue-500">Portal</span></h2>
            <p class="text-gray-400 text-sm max-w-sm mx-auto">Verify your booking status and exclusive reservation details securely.</p>
        </div>
        
        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 p-6 md:p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] mb-8">
            <form method="POST" class="flex flex-col gap-4">
                <div class="relative">
                    <i data-lucide="phone" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500"></i>
                    <input 
                        type="tel" 
                        name="phone"
                        placeholder="Enter Registered Phone" 
                        value="<?php echo htmlspecialchars($phone); ?>"
                        class="w-full bg-black/40 border border-white/10 rounded-2xl pl-12 pr-5 py-5 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition-all"
                        required
                    />
                </div>
                <button type="submit" name="check_status" class="w-full justify-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-bold py-5 rounded-2xl transition-all flex items-center gap-3 shadow-xl shadow-blue-900/20 group">
                    Track My Booking 
                    <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>
            
            <?php if($error): ?>
                <div class="flex items-center gap-3 p-4 mt-5 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm animate-shake">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($myBookings): ?>
            <div class="space-y-5 animate-in fade-in slide-in-from-bottom-5 duration-700">
                <div class="flex items-center justify-between px-2">
                    <h3 class="text-white font-bold text-lg">Found Reservations</h3>
                    <span class="bg-blue-600/20 text-blue-400 text-xs px-3 py-1 rounded-full border border-blue-500/20"><?php echo count($myBookings); ?> Bookings</span>
                </div>
                
                <?php foreach ($myBookings as $booking): ?>
                    <div class="group bg-[#0a0f1c]/60 backdrop-blur-md rounded-3xl p-6 border border-white/5 hover:border-blue-500/30 transition-all duration-300">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-16 bg-blue-600/10 rounded-2xl flex items-center justify-center text-blue-500 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                                    <i data-lucide="car" class="w-8 h-8"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-xl"><?php echo $booking['car_name']; ?></h4>
                                    <div class="flex flex-col gap-1 mt-1">
                                        <span class="flex items-center gap-2 text-gray-400 text-sm">
                                            <i data-lucide="calendar" class="w-4 h-4"></i> <?php echo $booking['booking_dates']; ?>
                                        </span>
                                        <span class="text-blue-400 font-bold text-sm">Total: AED <?php echo number_format($booking['total_price']); ?></span>
                                    </div>
                                </div>
                            </div>

                            <?php 
                                $status = $booking['status'];
                                $class = "bg-yellow-500/10 text-yellow-500 border-yellow-500/20";
                                $icon = "clock";
                                if ($status == 'Confirmed') { $class = "bg-green-500/10 text-green-500 border-green-500/20"; $icon = "check-circle"; }
                                if ($status == 'Rejected') { $class = "bg-red-500/10 text-red-500 border-red-500/20"; $icon = "x-circle"; }
                            ?>
                            <div class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest border <?php echo $class; ?>">
                                <i data-lucide="<?php echo $icon; ?>" class="w-4 h-4"></i>
                                <?php echo $status; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="text-center mt-12">
            <a href="index.php" class="inline-flex items-center gap-2 text-gray-500 hover:text-white text-sm transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                Return to Showroom
            </a>
        </div>
    </div>
</div>

<style>
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    .animate-shake { animation: shake 0.4s ease-in-out; }
</style>

<?php include 'footer.php'; ?>