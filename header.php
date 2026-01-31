

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>Al Rahal Rentals</title>
    <style>
        #main-nav {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-scrolled {
            background-color: #050810 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }
        .mobile-menu-open {
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50">

    <?php 
        $current_page = basename($_SERVER['PHP_SELF']); 
    ?>

    <nav id="main-nav" class="fixed top-0 w-full z-50 py-5 bg-transparent">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            
            <a href="index.php" class="z-50 relative flex items-center">
                <img src="assets/logo.png" alt="Al Rahal" class="h-10 md:h-14 w-auto object-contain drop-shadow-lg" />
            </a>

            <div class="hidden md:flex items-center gap-8">
                <?php
                $navLinks = [
                    'index.php' => 'HOME',
                    'fleet.php' => 'FLEET',
                    'services.php' => 'SERVICES',
                    'contact.php' => 'CONTACT'
                ];

                foreach($navLinks as $url => $label):
                    $isActive = ($current_page == $url) || ($current_page == '' && $url == 'index.php');
                ?>
                    <a href="<?php echo $url; ?>" class="relative group text-sm tracking-wide transition-colors <?php echo $isActive ? 'text-blue-500 font-bold' : 'text-gray-300 hover:text-white'; ?>">
                        <?php echo $label; ?>
                        <span class="absolute -bottom-2 left-0 h-[2px] bg-blue-500 transition-all duration-300 <?php echo $isActive ? 'w-full' : 'w-0 group-hover:w-full'; ?>"></span>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="hidden md:flex items-center gap-3">
                <a href="client-portal.php" class="px-4 py-2 text-xs font-bold text-white border border-white/20 rounded-lg hover:bg-white/10 transition-all flex items-center gap-2">
                    <i data-lucide="search" class="w-4 h-4"></i> Track Booking
                </a>
                <a href="login.php" class="px-5 py-2 text-xs font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-lg shadow-blue-900/20 transition-all flex items-center gap-2">
                    <i data-lucide="user" class="w-4 h-4"></i> Admin
                </a>
            </div>

            <button id="menu-toggle" class="md:hidden text-white p-2 rounded-lg hover:bg-white/10 transition-colors z-50 relative">
                <i id="menu-icon" data-lucide="menu" class="w-7 h-7"></i>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" class="fixed inset-0 z-40 bg-[#0a0f1c] md:hidden flex flex-col transition-transform duration-300 translate-x-full h-screen">
        <div class="flex-1 overflow-y-auto px-8 pt-28 pb-10">
            <div class="space-y-6 mb-12">
                <?php foreach($navLinks as $url => $label): ?>
                    <a href="<?php echo $url; ?>" class="text-xl font-bold flex justify-between items-center group border-b border-white/10 pb-4 tracking-wide relative <?php echo ($current_page == $url) ? 'text-white' : 'text-gray-300'; ?>">
                        <?php echo $label; ?> 
                        <i data-lucide="chevron-right" class="text-blue-500 w-5 h-5"></i>
                        <?php if($current_page == $url): ?>
                            <span class="absolute bottom-0 left-0 w-full h-[1px] bg-blue-500"></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="space-y-3">
                <a href="client-portal.php" class="w-full py-3 rounded-xl bg-[#151b2b] border border-white/20 text-white text-sm font-bold flex items-center justify-center gap-3 active:scale-95 transition-all">
                    <i data-lucide="search" class="text-blue-400 w-4 h-4"></i> Track Booking
                </a>
                <a href="login.php" class="w-full py-3 rounded-xl bg-gradient-to-r from-blue-600 to-blue-800 text-white text-sm font-bold flex items-center justify-center gap-3 shadow-lg shadow-blue-900/30 active:scale-95 transition-all">
                    <i data-lucide="user" class="w-4 h-4"></i> Admin Access
                </a>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const nav = document.getElementById('main-nav');
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const currentPage = "<?php echo $current_page; ?>";
        const handleScroll = () => {
            if (window.scrollY > 50 || (currentPage !== 'index.php' && currentPage !== '')) {
                nav.classList.add('nav-scrolled');
                nav.classList.remove('py-5');
                nav.classList.add('py-3');
            } else {
                nav.classList.remove('nav-scrolled');
                nav.classList.add('py-5');
                nav.classList.remove('py-3');
            }
        };

        window.addEventListener('scroll', handleScroll);
        window.addEventListener('load', handleScroll);
        let isOpen = false;
        menuToggle.addEventListener('click', () => {
            isOpen = !isOpen;
            if (isOpen) {
                mobileMenu.classList.remove('translate-x-full');
                document.body.classList.add('mobile-menu-open');
                menuIcon.setAttribute('data-lucide', 'x');
            } else {
                mobileMenu.classList.add('translate-x-full');
                document.body.classList.remove('mobile-menu-open');
                menuIcon.setAttribute('data-lucide', 'menu');
            }
            lucide.createIcons(); 
        });
    </script>