<?php 
?>
<footer class="bg-[#020305] text-white pt-20 pb-10 font-sans border-t border-white/5 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-blue-600 to-transparent opacity-50"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-16">
            
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <img src="assets/logo.png" alt="Al Rahal" class="h-10 w-auto object-contain" />
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Experience the thrill of driving the world's most exclusive vehicles. Premium service, 24/7 support.
                </p>
                <div class="flex gap-4">
                    <?php 
                    $socialIcons = ['facebook', 'instagram', 'linkedin', 'twitter'];
                    foreach($socialIcons as $icon): ?>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition-all duration-300">
                            <i data-lucide="<?php echo $icon; ?>" class="w-[18px] h-[18px]"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold text-lg mb-6">Quick Links</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <?php 
                    $links = ['Home' => 'index.php', 'Our Fleet' => 'fleet.php', 'Services' => 'services.php', 'Contact Us' => 'contact.php', 'Track Booking' => 'client-portal.php'];
                    foreach($links as $label => $url): ?>
                        <li>
                            <a href="<?php echo $url; ?>" class="hover:text-blue-400 transition-colors flex items-center gap-2 group">
                                <span class="w-1 h-1 rounded-full bg-blue-500 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                <?php echo $label; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-lg mb-6">Contact Us</h4>
                <ul class="space-y-4 text-sm text-gray-500">
                    <li class="flex items-start gap-3">
                        <i data-lucide="map-pin" class="text-blue-500 flex-shrink-0 mt-1 w-[18px] h-[18px]"></i>
                        <span>Al Rashidiya 3 Opposite ,<br />Ladies Park, Ajman UAE</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="phone" class="text-blue-500 flex-shrink-0 w-[18px] h-[18px]"></i>
                        <span>+971 56 668 7077</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i data-lucide="mail" class="text-blue-500 flex-shrink-0 w-[18px] h-[18px]"></i>
                        <span>booking@alrahal.com</span>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-lg mb-6">Find Us</h4>
                <div class="w-full h-40 rounded-xl overflow-hidden border border-white/10 relative group">
                    <iframe 
                        title="Al Rahal Location"
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        scrolling="no" 
                        src="https://maps.google.com/maps?q=Al%20Rashidiya%203%20Ajman&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        style="filter: invert(90%) hue-rotate(180deg) contrast(90%);" 
                        allowfullscreen="" 
                        loading="lazy"
                    ></iframe>
                    
                    <a href="https://maps.google.com/maps?q=Al%20Rashidiya%203%20Ajman" target="_blank" class="absolute inset-0 bg-blue-900/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="flex items-center gap-2 text-white font-bold tracking-wider text-sm">
                            OPEN MAP <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </div>
                    </a>
                </div>
                <p class="text-xs text-gray-500 mt-3">
                    Visit our showroom for a test drive. Open Daily 9 AM - 10 PM.
                </p>
            </div>

        </div>

        <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-600 text-xs">
                © <?php echo date("Y"); ?> Al Rahal Car Rental. All rights reserved.
            </p>
            <div class="flex gap-6 text-xs text-gray-600">
                <a href="#" class="hover:text-blue-400 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-blue-400 transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
</body>
</html>