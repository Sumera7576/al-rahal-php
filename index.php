<?php 

include 'db.php'; 
include 'header.php'; 
?>

<div class="relative w-full min-h-screen flex flex-col font-sans">
    <div class="flex-grow relative flex items-center justify-center">
        <div class="absolute inset-0 z-0">
            <img src="assets/Hero-bg.jpeg" alt="Dubai Luxury Car Rental" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-blue-900/10 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0f1c] via-black/40 to-black/20"></div>
        </div>

        <div class="relative z-10 w-full max-w-5xl mx-auto px-4 text-center mt-20 md:mt-0">
            <h2 class="text-blue-300 inline-block px-3 py-1 md:px-4 rounded-full border border-blue-300/30 bg-blue-900/20 backdrop-blur-md text-[9px] md:text-[10px] font-bold tracking-[0.3em] uppercase mb-4 md:mb-6">
                Premium Mobility
            </h2>
            <h1 class="text-4xl md:text-7xl font-extrabold text-white mb-6 leading-tight drop-shadow-2xl">
                Drive The <br />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-blue-100 to-blue-300 filter drop-shadow-lg">
                    Extraordinary
                </span>
            </h1>
            
            <p class="text-blue-50/80 text-sm md:text-lg max-w-xs md:max-w-2xl mx-auto mb-8 md:mb-12 font-light tracking-wide leading-relaxed">
                Dubai's most exclusive fleet. Instant booking, seamless delivery.
            </p>

            <form action="fleet.php" method="GET" class="w-full max-w-3xl mx-auto bg-white/95 backdrop-blur-xl rounded-3xl md:rounded-full shadow-2xl p-2 flex flex-col md:flex-row gap-2 relative border border-white/50">
                <div class="flex-1 relative group h-14 md:h-16 flex items-center px-4 md:px-6 border-b md:border-b-0 md:border-r border-gray-200/50 hover:bg-blue-50/50 transition rounded-xl md:rounded-full">
                    <i data-lucide="map-pin" class="text-blue-600 mr-3 w-5 h-5"></i>
                    <div class="flex-grow text-left">
                        <label class="block text-[9px] uppercase font-bold text-blue-900/60 tracking-wider">Pick-up Location</label>
<input type="text" name="location" id="locationInput" list="uae-cities" placeholder="Dubai, Abu Dhabi..." class="w-full bg-transparent outline-none text-sm text-gray-800 font-bold" autocomplete="off" />

<datalist id="uae-cities">
    <option value="Dubai">
    <option value="Abu Dhabi">
    <option value="Sharjah">
    <option value="Ajman">
    <option value="Ras Al Khaimah">
    <option value="Fujairah">
    <option value="Umm Al Quwain">
</datalist>                    </div>
                </div>

                <div class="flex-1 h-14 md:h-16 flex items-center px-4 md:px-6 hover:bg-blue-50/50 transition rounded-xl md:rounded-full">
                    <i data-lucide="calendar" class="text-blue-600 mr-3 w-5 h-5"></i>
                    <div class="flex-grow text-left">
                        <label class="block text-[9px] uppercase font-bold text-blue-900/60 tracking-wider">Dates</label>
                        <input type="datetime-local" name="date" class="w-full bg-transparent outline-none text-xs text-gray-800 font-bold uppercase" />
                    </div>
                </div>

                <button type="submit" class="hidden md:flex bg-blue-600 text-white w-16 h-16 rounded-full items-center justify-center shadow-lg hover:bg-blue-700 transition-all">
                    <i data-lucide="search" class="w-6 h-6"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<?php 
include 'fleet.php'; 
include 'services.php';
include 'experience.php';
include 'testimonials.php';
include 'contact.php';
include 'footer.php'; 
?>

<script>
    lucide.createIcons();
</script>