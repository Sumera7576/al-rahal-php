<?php
session_start();
include 'db.php';
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'bookings';
$bookingQuery = "SELECT bookings.*, cars.name AS car_name, cars.image AS car_img 
                 FROM bookings 
                 LEFT JOIN cars ON bookings.car_id = cars.id 
                 ORDER BY bookings.id DESC";
$bookings = mysqli_query($conn, $bookingQuery);
$fleetQuery = "SELECT * FROM cars ORDER BY id DESC";
$fleet = mysqli_query($conn, $fleetQuery);

$inquiryQuery = "SELECT * FROM inquiries ORDER BY id DESC";
$inquiries = mysqli_query($conn, $inquiryQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>AL RAHAL | Admin Dashboard</title>
    <style>
        .glass-sidebar { background: rgba(10, 15, 28, 0.8); backdrop-filter: blur(20px); }
        .active-tab { background: linear-gradient(to right, #2563eb, #1e40af); border: 1px solid rgba(96, 165, 250, 0.5); }
        body { background-color: #050810; color: white; font-family: 'Inter', sans-serif; }
        .action-btn { transition: all 0.3s ease; }
        .action-btn:hover { transform: translateY(-2px); }
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-blue-900/20 via-[#050810] to-[#050810]">

    <aside class="w-72 glass-sidebar border-r border-white/5 flex flex-col p-6 shadow-2xl">
        <div class="mb-10 flex items-center gap-3 px-2">
            <div class="p-2 bg-blue-600/20 rounded-lg border border-blue-500/30">
                <i data-lucide="layout-dashboard" class="text-blue-400"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold tracking-wider uppercase">AL RAHAL</h2>
                <p class="text-[10px] text-blue-300 uppercase tracking-widest font-bold">Admin Panel</p>
            </div>
        </div>

        <nav class="space-y-3 flex-1">
            <a href="?tab=bookings" class="flex items-center gap-3 w-full p-3 rounded-xl transition-all font-medium text-sm <?php echo $activeTab=='bookings' ? 'active-tab shadow-lg shadow-blue-500/30' : 'text-gray-400 hover:bg-white/5 hover:text-white'; ?>">
                <i data-lucide="calendar" class="w-5 h-5"></i> Bookings
            </a>
            <a href="?tab=fleet" class="flex items-center gap-3 w-full p-3 rounded-xl transition-all font-medium text-sm <?php echo $activeTab=='fleet' ? 'active-tab shadow-lg shadow-blue-500/30' : 'text-gray-400 hover:bg-white/5 hover:text-white'; ?>">
                <i data-lucide="car" class="w-5 h-5"></i> Manage Fleet
            </a>
            <a href="?tab=inquiries" class="flex items-center gap-3 w-full p-3 rounded-xl transition-all font-medium text-sm <?php echo $activeTab=='inquiries' ? 'active-tab shadow-lg shadow-blue-500/30' : 'text-gray-400 hover:bg-white/5 hover:text-white'; ?>">
                <i data-lucide="mail" class="w-5 h-5"></i> Inquiries
            </a>
            <a href="add-car.php" class="flex items-center gap-3 w-full p-3 rounded-xl transition-all font-medium text-sm text-gray-400 hover:bg-white/5 hover:text-white">
                <i data-lucide="plus" class="w-5 h-5"></i> Add New Car
            </a>
        </nav>

        <a href="logout.php" class="flex items-center gap-3 text-red-400 hover:text-red-300 p-4 hover:bg-red-500/10 rounded-xl transition-colors font-medium text-sm">
            <i data-lucide="log-out" class="w-5 h-5"></i> Logout
        </a>
    </aside>

    <main class="flex-1 overflow-y-auto p-8">
        <header class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight uppercase italic">
                <?php 
                    if($activeTab == 'bookings') echo 'Booking <span class="text-blue-500">Requests</span>';
                    elseif($activeTab == 'fleet') echo 'Fleet <span class="text-blue-500">Management</span>';
                    else echo 'Customer <span class="text-blue-500">Inquiries</span>';
                ?>
            </h1>
        </header>

        <?php if($activeTab == 'bookings'): ?>
        <div class="bg-white/5 backdrop-blur-md rounded-3xl border border-white/10 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/5 text-gray-400 text-[10px] uppercase tracking-[0.2em] border-b border-white/10">
                            <th class="p-5">Client & Contact</th>
                            <th class="p-5">Car</th>
                            <th class="p-5">Booking Date/Time</th>
                            <th class="p-5">Status</th>
                            <th class="p-5 text-right">Quick Reply & Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-white/5">
                        <?php while($row = mysqli_fetch_assoc($bookings)): ?>
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="p-5">
                                <div class="font-bold text-white"><?php echo isset($row['customer_name']) ? $row['customer_name'] : 'No Name'; ?></div>
                                <div class="text-blue-400 text-xs font-medium"><?php echo $row['customer_phone']; ?></div>
                            </td>
                            <td class="p-5 font-bold text-gray-300">
                                <?php echo !empty($row['car_name']) ? $row['car_name'] : 'Unknown Car'; ?>
                            </td>
                            <td class="p-5">
                                <div class="text-white font-medium italic"><?php echo isset($row['pickup_date']) ? $row['pickup_date'] : 'N/A'; ?></div>
                                <div class="text-[10px] text-gray-500"><?php echo isset($row['created_at']) ? 'Requested: '.$row['created_at'] : ''; ?></div>
                            </td>
                            <td class="p-5">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                            <td class="p-5 text-right">
                                <div class="flex gap-2 justify-end items-center">
                                    <a href="https://wa.me/<?php echo $row['customer_phone']; ?>?text=Hello <?php echo $row['customer_name']; ?>, regarding your Al Rahal booking for <?php echo $row['car_name']; ?>..." target="_blank" class="action-btn p-2 bg-green-500/10 text-green-500 rounded-lg border border-green-500/20 hover:bg-green-500 hover:text-white shadow-lg">
                                        <i data-lucide="message-square" class="w-4 h-4"></i>
                                    </a>
                                    <a href="mailto:?to=<?php echo isset($row['customer_email']) ? $row['customer_email'] : ''; ?>&subject=Al Rahal Car Rental Update" class="action-btn p-2 bg-blue-500/10 text-blue-400 rounded-lg border border-blue-500/20 hover:bg-blue-500 hover:text-white shadow-lg">
                                        <i data-lucide="mail" class="w-4 h-4"></i>
                                    </a>
                                    <div class="w-[1px] h-4 bg-white/10 mx-1"></div>
                                    <a href="update_booking.php?id=<?php echo $row['id']; ?>&status=Confirmed" class="action-btn p-2 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow-xl shadow-green-900/20"><i data-lucide="check" class="w-4 h-4"></i></a>
                                    <a href="update_booking.php?id=<?php echo $row['id']; ?>&status=Rejected" class="action-btn p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 shadow-xl shadow-red-900/20"><i data-lucide="x" class="w-4 h-4"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <?php if($activeTab == 'inquiries'): ?>
        <div class="bg-white/5 backdrop-blur-md rounded-3xl border border-white/10 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/5 text-gray-400 text-[10px] uppercase tracking-[0.2em] border-b border-white/10">
                            <th class="p-5">Client</th>
                            <th class="p-5">Message</th>
                            <th class="p-5 text-right">Connect Now</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-white/5">
                        <?php while($msg = mysqli_fetch_assoc($inquiries)): ?>
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="p-5">
                                <div class="font-bold text-white"><?php echo $msg['customer_name']; ?></div>
                                <div class="text-xs text-gray-500"><?php echo $msg['customer_email']; ?></div>
                            </td>
                            <td class="p-5 text-gray-300 italic max-w-xs truncate">"<?php echo $msg['message']; ?>"</td>
                            <td class="p-5 text-right">
                                <div class="flex gap-3 justify-end">
                                    <a href="https://wa.me/<?php echo $msg['customer_phone']; ?>" target="_blank" class="action-btn flex items-center gap-2 px-4 py-2 bg-green-600/20 text-green-400 rounded-xl border border-green-500/20 hover:bg-green-600 hover:text-white transition-all text-xs font-bold">
                                        <i data-lucide="phone" class="w-3 h-3"></i> WhatsApp
                                    </a>
                                    <a href="mailto:<?php echo $msg['customer_email']; ?>" class="action-btn flex items-center gap-2 px-4 py-2 bg-blue-600/20 text-blue-400 rounded-xl border border-blue-500/20 hover:bg-blue-600 hover:text-white transition-all text-xs font-bold">
                                        <i data-lucide="mail" class="w-3 h-3"></i> Email
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <?php if($activeTab == 'fleet'): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php while($car = mysqli_fetch_assoc($fleet)): ?>
            <div class="group bg-white/5 backdrop-blur-md border border-white/10 p-4 rounded-3xl shadow-xl hover:-translate-y-2 transition-all duration-300">
                <img src="<?php echo (strpos($car['image'], 'http') !== false) ? $car['image'] : 'assets/'.$car['image']; ?>" class="w-full h-40 object-cover rounded-2xl mb-4 grayscale group-hover:grayscale-0 transition-all">
                <h3 class="font-bold text-lg text-white"><?php echo $car['name']; ?></h3>
                <p class="text-blue-400 font-bold mb-4 italic text-sm">AED <?php echo $car['price']; ?> <span class="text-gray-600 not-italic text-[10px]">/day</span></p>
                <div class="flex gap-2 pt-4 border-t border-white/5">
                    <a href="edit-car.php?id=<?php echo $car['id']; ?>" class="flex-1 bg-white/10 text-center py-2 rounded-xl text-[10px] font-bold uppercase tracking-widest hover:bg-blue-600 transition-all border border-white/5">Edit</a>
                    <a href="delete-car.php?id=<?php echo $car['id']; ?>" onclick="return confirm('Delete this vehicle?')" class="flex-1 bg-red-600/10 text-center py-2 rounded-xl text-[10px] font-bold uppercase tracking-widest text-red-500 border border-red-500/20 hover:bg-red-600 hover:text-white transition-all">Delete</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

    </main>

    <script>lucide.createIcons();</script>
</body>
</html>