<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
$query = "SELECT * FROM cars ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>Manage Fleet | Admin</title>
</head>
<body class="bg-[#050810] text-white p-8">

    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-bold tracking-tight uppercase italic">Manage <span class="text-blue-500">Fleet</span></h1>
            <a href="add-car.php" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all">
                <i data-lucide="plus"></i> Add New Car
            </a>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-[2rem] overflow-hidden backdrop-blur-xl">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/5 text-blue-400 text-xs uppercase tracking-widest">
                        <th class="p-6">Vehicle</th>
                        <th class="p-6">Category</th>
                        <th class="p-6">Price</th>
                        <th class="p-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="p-6 flex items-center gap-4">
                            <img src="assets/<?php echo $row['image']; ?>" class="w-20 h-12 object-cover rounded-lg border border-white/10">
                            <div>
                                <div class="font-bold text-lg"><?php echo $row['name']; ?></div>
                                <div class="text-gray-500 text-xs">📍 <?php echo $row['location']; ?></div>
                            </div>
                        </td>
                        <td class="p-6">
                            <span class="bg-blue-500/10 text-blue-400 px-3 py-1 rounded-full text-[10px] font-bold uppercase border border-blue-500/20">
                                <?php echo $row['category']; ?>
                            </span>
                        </td>
                        <td class="p-6 font-bold text-blue-400">AED <?php echo $row['price']; ?></td>
                        <td class="p-6 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="edit-car.php?id=<?php echo $row['id']; ?>" class="p-2 bg-white/5 hover:bg-white/10 rounded-lg text-gray-400 hover:text-white transition-all">
                                    <i data-lucide="edit-3" class="w-5 h-5"></i>
                                </a>
                                <a href="delete-car.php?id=<?php echo $row['id']; ?>" 
                                   onclick="return confirm('Are you sure you want to delete this beast?')" 
                                   class="p-2 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-lg transition-all">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </a>
                            </div>
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