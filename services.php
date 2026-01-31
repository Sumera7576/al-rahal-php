<?php
if (!defined('NAVBAR_LOADED')) {
    include_once 'header.php';
    define('NAVBAR_LOADED', true);
}
?>
<?php 
include_once 'db.php'; 
?>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<section id="services" class="py-24 bg-[#0B0F19] text-white font-sans overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-20">
            <span class="text-blue-500 font-bold tracking-[0.2em] text-[10px] uppercase mb-3 block px-4 py-1 bg-blue-500/10 w-fit mx-auto rounded-full border border-blue-500/20">
                Premium Mobility
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 tracking-tight">
                Our Exclusive <span class="text-blue-400">Services</span>
            </h2>
            <p class="text-gray-400 text-lg font-light leading-relaxed">
                Tailored solutions for those who demand nothing but the best in the heart of Dubai.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $services = [
                ['icon' => 'user-check', 'title' => 'Elite Chauffeur', 'desc' => 'Professional drivers in uniform, trained for VIP protocol and complete discretion.'],
                ['icon' => 'plane', 'title' => 'Airport Transfer', 'desc' => 'Seamless pickups from DXB & DWC. From the tarmac to your hotel in style.'],
                ['icon' => 'gem', 'title' => 'Wedding Fleet', 'desc' => 'Make a grand entrance with our ultra-luxury Rolls Royce and Limousines.'],
                ['icon' => 'phone', 'title' => '24/7 Concierge', 'desc' => 'Your personal travel assistant for bookings, changes, and special requests.'],
                ['icon' => 'shield-check', 'title' => 'Full Insurance', 'desc' => 'Comprehensive coverage included. Drive with zero liability and 100% peace of mind.'],
                ['icon' => 'clock', 'title' => 'Express Delivery', 'desc' => 'We bring the car to you. Doorstep delivery anywhere in Dubai within 60 mins.']
            ];

            foreach ($services as $service):
            ?>
            <div class="group relative bg-[#131825] p-10 rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-3 border border-white/5 hover:border-blue-500/30 shadow-2xl">
                
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-blue-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative z-10 w-16 h-16 bg-[#0B0F19] rounded-2xl flex items-center justify-center text-blue-500 mb-8 group-hover:text-white group-hover:bg-blue-600 group-hover:rotate-[360deg] transition-all duration-700 shadow-xl border border-white/5">
                    <i data-lucide="<?php echo $service['icon']; ?>" class="w-8 h-8"></i>
                </div>

                <div class="relative z-10">
                    <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-blue-400 transition-colors">
                        <?php echo $service['title']; ?>
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4 group-hover:text-gray-300 transition-colors">
                        <?php echo $service['desc']; ?>
                    </p>
                </div>

                <div class="absolute bottom-0 left-0 h-1.5 w-0 bg-gradient-to-r from-blue-600 via-blue-400 to-cyan-400 transition-all duration-700 ease-in-out group-hover:w-full"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

<?php
if (basename($_SERVER['PHP_SELF']) !== 'index.php') {
    include_once 'footer.php';
}
?>