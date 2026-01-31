<?php 
?>
<section class="py-24 bg-[#0a0f1c] relative overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600/10 blur-[100px] rounded-full -z-10"></div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-bold text-white">What Our <span class="text-blue-500">Clients Say</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            $reviews = [
                ['name' => 'Ahmed Khan', 'role' => 'Business Traveler', 'text' => 'The Lamborghini Urus was in pristine condition. Excellent service from Al Rahal.'],
                ['name' => 'Sarah Johnson', 'role' => 'Tourist', 'text' => 'Best car rental experience in Dubai. Seamless delivery to my hotel in Palm Jumeirah.'],
                ['name' => 'James Wilson', 'role' => 'CEO', 'text' => 'Professional chauffeur and ultra-luxury fleet. Highly recommended for corporate trips.']
            ];

            foreach($reviews as $rev):
            ?>
            <div class="p-8 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md hover:border-blue-500/50 transition-all duration-500 group">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                </div>
                <p class="text-gray-400 italic mb-6">"<?php echo $rev['text']; ?>"</p>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold text-white uppercase">
                        <?php echo substr($rev['name'], 0, 1); ?>
                    </div>
                    <div>
                        <h4 class="text-white font-bold"><?php echo $rev['name']; ?></h4>
                        <p class="text-blue-400 text-xs uppercase tracking-tighter"><?php echo $rev['role']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    if(typeof lucide !== 'undefined') { lucide.createIcons(); }
</script>