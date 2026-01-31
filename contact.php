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

<style>
    .contact-page-bg { background-color: #050810; min-height: 100vh; position: relative; }
    .custom-input:focus {
        background: rgba(10, 15, 28, 0.9) !important;
        border-color: #3b82f6 !important;
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
    }
    #success-overlay {
        display: none;
        position: absolute;
        inset: 0;
        background: rgba(5, 8, 16, 0.95);
        z-index: 50;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 2.5rem;
        text-align: center;
        backdrop-filter: blur(10px);
    }
    .checkmark-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #10b981;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: 0 0 30px rgba(16, 185, 129, 0.4);
        animation: scaleIn 0.5s ease;
    }
    @keyframes scaleIn { from { transform: scale(0); } to { transform: scale(1); } }
</style>

<div class="contact-page-bg">
    <section class="relative py-32 overflow-hidden text-white font-sans">
        <div class="absolute inset-0 z-0 opacity-40">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover filter blur-[2px]">
            <div class="absolute inset-0 bg-[#050810]/80"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <h2 class="text-5xl font-extrabold leading-tight">Let's Start Your <br><span class="text-blue-400">Journey.</span></h2>
                    <p class="text-gray-400 text-lg">Ready to drive? Visit our showroom or send us a message.</p>
                </div>

                <div class="relative">
                    <div id="form-container" class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
                        
                        <div id="success-overlay">
                            <div class="checkmark-circle">
                                <i data-lucide="check" class="text-white w-10 h-10"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Message Sent!</h3>
                            <p class="text-gray-400 text-sm">Thank you for reaching out. <br> Our team will contact you shortly.</p>
                            <button onclick="location.reload()" class="mt-6 text-blue-400 text-xs uppercase tracking-widest font-bold border-b border-blue-400 pb-1">Send Another</button>
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-8 flex items-center gap-3">
                            Make an Inquiry <i data-lucide="send" class="text-blue-500 w-5 h-5"></i>
                        </h3>
                        
                        <form id="contactForm" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest ml-1">Full Name</label>
                                    <input type="text" name="name" placeholder="Enter Your Name" required class="custom-input w-full bg-black/40 border border-white/10 rounded-2xl px-4 py-4 text-white outline-none transition-all" />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest ml-1">Phone Number</label>
                                    <input type="tel" name="phone" placeholder="Enter Your Number" required class="custom-input w-full bg-black/40 border border-white/10 rounded-2xl px-4 py-4 text-white outline-none transition-all" />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest ml-1">Email Address</label>
                                <input type="email" name="email" placeholder="Enter Your Email" required class="custom-input w-full bg-black/40 border border-white/10 rounded-2xl px-4 py-4 text-white outline-none transition-all" />
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest ml-1">Your Message</label>
                                <textarea name="message" rows="4" placeholder="Enter Your Message" required class="custom-input w-full bg-black/40 border border-white/10 rounded-2xl px-4 py-4 text-white outline-none transition-all resize-none"></textarea>
                            </div>

                            <button type="submit" id="submitBtn" class="w-full py-4 rounded-2xl bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold text-sm tracking-widest uppercase transition-all flex items-center justify-center gap-3 group">
                                <span id="btnText">Send Message</span>
                                <i id="btnIcon" data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    lucide.createIcons();

    $(document).ready(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();
            let $btn = $('#submitBtn');
            let $btnText = $('#btnText');
            $btn.prop('disabled', true).addClass('opacity-70 cursor-not-allowed');
            $btnText.text('Sending Message...');
            
            $.ajax({
                url: 'send_inquiry.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#success-overlay').css('display', 'flex').hide().fadeIn();
                    lucide.createIcons();
                },
                error: function() {
                    alert('Something went wrong. Please try again.');
                    $btn.prop('disabled', false).removeClass('opacity-70 cursor-not-allowed');
                    $btnText.text('Send Message');
                }
            });
        });
    });
</script>
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