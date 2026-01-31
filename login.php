<?php
session_start();
include 'db.php';
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-dashboard.php");
    exit();
}

$error = '';
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin-dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}
include 'header.php'; 
?>

<style>
    body {
        background-color: #050810 !important;
        margin: 0;
    }
    .login-wrapper {
        min-height: 100vh; 
        display: flex;
        align-items: center; 
        justify-content: center;
        position: relative;
        z-index: 10;
        padding-top: 100px; 
        padding-bottom: 60px;
    }

    .glass-login {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        width: 100%;
        max-width: 420px;
    }
</style>

<div class="login-wrapper">
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/3 left-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-1/3 right-1/4 w-96 h-96 bg-blue-900/10 rounded-full blur-[120px]"></div>
    </div>

    <div class="w-full max-w-md px-6 relative z-10">
        <div class="text-center mb-8">
          
            <h1 class="text-4xl font-extrabold text-white tracking-tight">Admin <span class="text-blue-500">Access</span></h1>
            <p class="text-gray-500 text-[10px] uppercase tracking-[0.3em] mt-2">Al Rahal Luxury Rentals</p>
        </div>

        <div class="glass-login p-8 md:p-10 rounded-[2.5rem] shadow-2xl mx-auto">
            <form action="login.php" method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest ml-1">Username</label>
                    <div class="relative group">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500 transition-colors group-focus-within:text-blue-500"></i>
                        <input type="text" name="username" placeholder="Enter Your Name" class="w-full bg-black/40 border border-white/10 rounded-2xl pl-12 pr-4 py-4 text-white focus:border-blue-500 outline-none transition-all" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest ml-1">Password</label>
                    <div class="relative group">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500 transition-colors group-focus-within:text-blue-500"></i>
                        <input type="password" name="password" placeholder="Enter Your Password" class="w-full bg-black/40 border border-white/10 rounded-2xl pl-12 pr-4 py-4 text-white focus:border-blue-500 outline-none transition-all" required>
                    </div>
                </div>

                <?php if($error): ?>
                    <div class="text-red-400 text-xs font-bold text-center bg-red-500/10 py-3 rounded-xl border border-red-500/20 animate-pulse">
                        <i data-lucide="alert-circle" class="inline w-3 h-3 mr-1"></i> <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <button type="submit" name="login" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all shadow-lg flex items-center justify-center gap-2 group uppercase tracking-widest text-xs">
                    Sign In <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>
        </div>

        <div class="text-center mt-8">
            <a href="index.php" class="text-gray-500 hover:text-white text-xs transition-colors flex items-center justify-center gap-2 group">
                <i data-lucide="chevron-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i> Back to Showroom
            </a>
        </div>
    </div>
</div>

<?php 
include 'footer.php'; 
?>