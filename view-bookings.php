<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
$query = "SELECT bookings.*, cars.name as car_name, cars.image as car_img 
          FROM bookings 
          JOIN cars ON bookings.car_id = cars.id 
          ORDER BY bookings.id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>Manage Bookings | Admin</title>
</head>
<body class="bg-[#050810] text-white p-8 font-sans">

    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-bold tracking-tight uppercase italic">Booking <span class="text-blue-500">Requests</span></h1>
            <div class="flex gap-4">
                <div class="bg-white/5 px-4 py-2 rounded-lg border border-white/10 text-xs font-bold uppercase text-gray-400">
                    Total: <?php echo mysqli_num_rows($result); ?>
                </div>
            </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden backdrop-blur-2xl shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 text-blue-400 text-[10px] uppercase tracking-[0.2em] font-black">
                        <th class="p-6">Client & Car</th>
                        <th class="p-6">Dates & Total</th>
                        <th class="p-6">Status</th>
                        <th class="p-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="hover:bg-white/5 transition-all">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <img src="assets/<?php echo $row['car_img']; ?>" class="w-16 h-10 object-cover rounded-lg border border-white/10">
                                <div>
                                    <div class="font-bold text-white"><?php echo $row['customer_name']; ?></div>
                                    <div class="text-blue-400 text-xs font-medium"><?php echo $row['car_name']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="p-6">
                            <div class="text-sm font-bold text-gray-300"><?php echo $row['pickup_date']; ?> <span class="text-blue-500">→</span> <?php echo $row['return_date']; ?></div>
                            <div class="text-xs text-green-400 mt-1 font-black uppercase">AED <?php echo number_format($row['total_price']); ?></div>
                        </td>
                        <td class="p-6">
                            <?php 
                                $status = $row['status'];
                                $color = ($status == 'Confirmed') ? 'bg-green-500/10 text-green-400 border-green-500/30' : (($status == 'Rejected') ? 'bg-red-500/10 text-red-400 border-red-500/30' : 'bg-yellow-500/10 text-yellow-400 border-yellow-500/30');
                            ?>
                            <span class="<?php echo $color; ?> px-3 py-1 rounded-full text-[10px] font-black uppercase border tracking-widest">
                                <?php echo $status; ?>
                            </span>
                        </td>
                        <td class="p-6 text-right">
                            <?php if($status == 'Pending'): ?>
                            <div class="flex justify-end gap-2">
                                <a href="update-status.php?id=<?php echo $row['id']; ?>&status=Confirmed" class="p-2 bg-green-600/20 hover:bg-green-600 text-green-400 hover:text-white rounded-lg transition-all shadow-lg" title="Approve">
                                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                                </a>
                                <a href="update-status.php?id=<?php echo $row['id']; ?>&status=Rejected" class="p-2 bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white rounded-lg transition-all shadow-lg" title="Reject">
                                    <i data-lucide="x-circle" class="w-5 h-5"></i>
                                </a>
                            </div>
                            <?php else: ?>
                                <span class="text-gray-600 text-[10px] uppercase font-bold italic">Processed</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>